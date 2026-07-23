<?php

namespace App\Services;

use App\Models\ExchangeRate;
use App\Models\Setting;
use App\Services\Providers\FawazAhmedExchangeRateProvider;
use App\Services\Providers\FrankfurterExchangeRateProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Throwable;

class ExchangeRateManager implements ExchangeRateServiceInterface
{
    /**
     * Array of registered provider instances keyed by unique identifier.
     *
     * @var array<string, ExchangeRateProviderInterface>
     */
    protected array $providers = [];

    public function __construct()
    {
        $this->registerProvider(new FrankfurterExchangeRateProvider());
        $this->registerProvider(new FawazAhmedExchangeRateProvider());
    }

    /**
     * Register a new exchange rate provider.
     */
    public function registerProvider(ExchangeRateProviderInterface $provider): void
    {
        $this->providers[$provider->getKey()] = $provider;
    }

    /**
     * Get all registered providers.
     *
     * @return array<string, ExchangeRateProviderInterface>
     */
    public function getProviders(): array
    {
        return $this->providers;
    }

    /**
     * Get active provider key from settings or config.
     */
    public function getActiveProviderKey(): string
    {
        $settingKey = Setting::where('key', 'exchange_rates_active_provider')->value('value');
        if ($settingKey && isset($this->providers[$settingKey])) {
            return $settingKey;
        }

        $configKey = config('services.exchange_rates.provider', 'frankfurter');
        if (isset($this->providers[$configKey])) {
            return $configKey;
        }

        return 'frankfurter';
    }

    /**
     * Get provider instance by key.
     */
    public function getProvider(string $key): ?ExchangeRateProviderInterface
    {
        return $this->providers[$key] ?? null;
    }

    /**
     * Fetch latest rates from external provider and update database.
     * Supports retry attempts and automatic failover to secondary provider.
     *
     * @param bool $force
     * @return bool
     */
    public function fetchAndUpdateRates(bool $force = false): bool
    {
        $startTime = microtime(true);

        try {
            // Check auto-update setting unless forced (manual refresh)
            if (!$force) {
                $autoUpdateSetting = Setting::where('key', 'exchange_rates_auto_update')->value('value');
                if ($autoUpdateSetting === 'false') {
                    Log::info('Exchange rates auto update is disabled in CMS settings.');
                    return false;
                }
            }

            // Retrieve CMS configuration settings
            $activeKey = $this->getActiveProviderKey();
            $autoFailover = Setting::where('key', 'exchange_rates_enable_auto_failover')->value('value') !== 'false';
            $timeout = (int) (Setting::where('key', 'exchange_rates_api_timeout')->value('value') ?? config('services.exchange_rates.timeout', 10));
            $retryAttempts = max(1, (int) (Setting::where('key', 'exchange_rates_retry_attempts')->value('value') ?? 2));
            $cacheDurationMinutes = (int) (Setting::where('key', 'exchange_rates_cache_duration')->value('value') ?? 10080); // Default 7 days
            $loggingEnabled = Setting::where('key', 'exchange_rates_enable_logging')->value('value') !== 'false';
            $sslVerify = (bool) config('services.exchange_rates.ssl_verify', false);

            // Determine provider trial order (Primary first, then failover candidates)
            $providerChain = [];
            if (isset($this->providers[$activeKey])) {
                $providerChain[] = $this->providers[$activeKey];
            }

            if ($autoFailover) {
                foreach ($this->providers as $key => $provider) {
                    if ($key !== $activeKey) {
                        $providerChain[] = $provider;
                    }
                }
            }

            $fetchResult = null;
            $lastException = null;
            $failedAttempts = [];

            foreach ($providerChain as $provider) {
                for ($attempt = 1; $attempt <= $retryAttempts; $attempt++) {
                    try {
                        $result = $provider->fetchRates('USD', $timeout, $sslVerify);
                        if ($result !== null && !empty($result['rates'])) {
                            $fetchResult = $result;
                            break 2; // Break both loops on success
                        } else {
                            $msg = "{$provider->getName()} (Attempt {$attempt}/{$retryAttempts}) returned empty or invalid payload.";
                            $failedAttempts[] = [
                                'provider' => $provider->getName(),
                                'attempt' => $attempt,
                                'url' => $provider->getBaseUrl(),
                                'error' => $msg,
                            ];
                        }
                    } catch (Throwable $e) {
                        $lastException = $e;
                        $failedAttempts[] = [
                            'provider' => $provider->getName(),
                            'attempt' => $attempt,
                            'url' => $provider->getBaseUrl(),
                            'error' => $e->getMessage(),
                            'trace' => $e->getTraceAsString(),
                        ];
                    }
                }
            }

            $totalLatencyMs = (int) round((microtime(true) - $startTime) * 1000);

            // If no provider succeeded
            if (!$fetchResult) {
                $errorMessage = $lastException ? $lastException->getMessage() : 'All exchange rate providers failed to respond.';
                
                if (!empty($failedAttempts) && isset(end($failedAttempts)['error'])) {
                    $errorMessage = end($failedAttempts)['error'];
                }

                $cacheStatus = Cache::has('exchange_rates_last_api_response') ? 'using_fallback' : 'no_cache';

                $this->saveDiagnosticState([
                    'status' => 'failed',
                    'last_failed_sync' => now()->toIso8601String(),
                    'last_error' => $errorMessage,
                    'last_response_code' => 0,
                    'last_response_time' => $totalLatencyMs,
                    'cache_status' => $cacheStatus,
                    'failover_active' => $autoFailover ? 'true' : 'false',
                ]);

                if ($loggingEnabled) {
                    Log::error("ExchangeRateManager failed to update rates from all providers.", [
                        'active_provider' => $activeKey,
                        'auto_failover' => $autoFailover,
                        'failed_attempts' => $failedAttempts,
                        'total_latency_ms' => $totalLatencyMs,
                    ]);
                }

                return false;
            }

            // Successful fetch! Process rates and update DB
            $rates = $fetchResult['rates'];
            $usedProviderName = $fetchResult['provider'];
            $usedUrl = $fetchResult['used_url'];
            $statusCode = $fetchResult['status_code'];
            $responseTimeMs = $fetchResult['response_time_ms'];

            // Determine USD to BDT base conversion rate
            $usdToBdt = 120.50; // Fallback default
            if (isset($rates['BDT']) && (float) $rates['BDT'] > 0) {
                $usdToBdt = (float) $rates['BDT'];
            } else {
                $usdRecord = ExchangeRate::where('currency_code', 'USD')->first();
                if ($usdRecord && $usdRecord->exchange_rate > 0) {
                    $usdToBdt = (float) $usdRecord->exchange_rate;
                }
            }

            // Cache raw payload for fallback
            Cache::put('exchange_rates_last_api_response', $fetchResult, now()->addMinutes($cacheDurationMinutes));

            // Update database records
            $currencies = ExchangeRate::all();

            foreach ($currencies as $currency) {
                $code = strtoupper($currency->currency_code);
                $calculatedRate = null;

                if ($code === 'BDT') {
                    $calculatedRate = 1.0000;
                } elseif ($code === 'USD') {
                    $calculatedRate = round($usdToBdt, 4);
                } elseif (isset($rates[$code]) && (float) $rates[$code] > 0) {
                    // rates[code] is 1 USD in units of code X. So 1 X in BDT = usdToBdt / rates[code]
                    $usdToX = (float) $rates[$code];
                    $calculatedRate = round($usdToBdt / $usdToX, 4);
                } elseif ($code === 'SAR') {
                    // Officially pegged to USD at 3.75 SAR / USD
                    $calculatedRate = round($usdToBdt / 3.75, 4);
                } elseif ($code === 'AED') {
                    // Officially pegged to USD at 3.6725 AED / USD
                    $calculatedRate = round($usdToBdt / 3.6725, 4);
                }

                if ($calculatedRate !== null && $calculatedRate > 0) {
                    $currency->live_rate = $calculatedRate;
                    $currency->last_updated_at = now();

                    if (!$currency->is_manual) {
                        $currency->previous_rate = $currency->exchange_rate;
                        $currency->exchange_rate = $calculatedRate;
                        $currency->source = 'live';
                    }

                    $currency->save();
                }
            }

            // Save successful diagnostic state
            $isFailover = ($fetchResult['provider_key'] !== $activeKey);
            $this->saveDiagnosticState([
                'status' => 'success',
                'current_provider' => $usedProviderName,
                'last_successful_sync' => now()->toIso8601String(),
                'last_error' => '',
                'last_response_code' => $statusCode > 0 ? $statusCode : 200,
                'last_response_time' => $responseTimeMs,
                'cache_status' => 'fresh',
                'failover_active' => $isFailover ? 'true' : 'false',
            ]);

            Setting::updateOrCreate(
                ['key' => 'exchange_rates_last_updated_at'],
                ['value' => now()->toIso8601String()]
            );

            if ($loggingEnabled) {
                Log::info("ExchangeRateManager updated rates successfully via {$usedProviderName} from {$usedUrl} in {$responseTimeMs}ms.", [
                    'failover_used' => $isFailover,
                ]);
            }

            return true;
        } catch (Throwable $e) {
            $totalLatencyMs = (int) round((microtime(true) - $startTime) * 1000);

            $this->saveDiagnosticState([
                'status' => 'failed',
                'last_failed_sync' => now()->toIso8601String(),
                'last_error' => $e->getMessage(),
                'last_response_code' => 0,
                'last_response_time' => $totalLatencyMs,
                'cache_status' => Cache::has('exchange_rates_last_api_response') ? 'using_fallback' : 'no_cache',
            ]);

            Log::error('ExchangeRateManager unexpected exception: ' . $e->getMessage(), ['exception' => $e]);

            return false;
        }
    }

    /**
     * Get real-time diagnostic information for CMS.
     *
     * @return array
     */
    public function getDiagnostics(): array
    {
        $settings = Setting::where('key', 'like', 'exchange_rates_%')->pluck('value', 'key');
        $activeKey = $this->getActiveProviderKey();
        $activeProvider = $this->getProvider($activeKey);

        $availableProviders = [];
        foreach ($this->providers as $key => $p) {
            $availableProviders[] = [
                'key' => $key,
                'name' => $p->getName(),
                'url' => $p->getBaseUrl(),
                'is_active' => ($key === $activeKey),
            ];
        }

        return [
            'active_provider_key' => $activeKey,
            'active_provider_name' => $activeProvider ? $activeProvider->getName() : 'Frankfurter API',
            'current_provider' => $settings->get('exchange_rates_current_provider', $activeProvider ? $activeProvider->getName() : 'Frankfurter API'),
            'api_url' => $activeProvider ? $activeProvider->getBaseUrl() : '',
            'status' => $settings->get('exchange_rates_status', 'unknown'),
            'last_successful_sync' => $settings->get('exchange_rates_last_successful_sync'),
            'last_failed_sync' => $settings->get('exchange_rates_last_failed_sync'),
            'last_error' => $settings->get('exchange_rates_last_error'),
            'last_response_code' => $settings->get('exchange_rates_last_response_code'),
            'last_response_time' => $settings->get('exchange_rates_last_response_time'),
            'cache_status' => $settings->get('exchange_rates_cache_status', 'fresh'),
            'enable_auto_failover' => $settings->get('exchange_rates_enable_auto_failover', 'true') !== 'false',
            'api_timeout' => (int) ($settings->get('exchange_rates_api_timeout') ?? config('services.exchange_rates.timeout', 10)),
            'retry_attempts' => (int) ($settings->get('exchange_rates_retry_attempts') ?? 2),
            'cache_duration' => (int) ($settings->get('exchange_rates_cache_duration') ?? 10080),
            'enable_logging' => $settings->get('exchange_rates_enable_logging', 'true') !== 'false',
            'available_providers' => $availableProviders,
        ];
    }

    /**
     * Test connection to specific provider.
     *
     * @param string $providerKey
     * @return array
     */
    public function testProviderConnection(string $providerKey): array
    {
        $provider = $this->getProvider($providerKey);
        if (!$provider) {
            return [
                'success' => false,
                'provider' => $providerKey,
                'provider_key' => $providerKey,
                'message' => "Unknown exchange rate provider key: {$providerKey}",
            ];
        }

        $timeout = (int) (Setting::where('key', 'exchange_rates_api_timeout')->value('value') ?? 5);
        $sslVerify = (bool) config('services.exchange_rates.ssl_verify', false);

        return $provider->testConnection($timeout, $sslVerify);
    }

    /**
     * Helper to save diagnostic settings.
     *
     * @param array $data
     */
    protected function saveDiagnosticState(array $data): void
    {
        foreach ($data as $key => $val) {
            Setting::updateOrCreate(
                ['key' => 'exchange_rates_' . $key],
                ['value' => $val !== null ? (string) $val : '']
            );
        }
    }
}
