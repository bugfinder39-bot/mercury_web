<?php

namespace App\Services;

use App\Models\ExchangeRate;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class FrankfurterExchangeRateService implements ExchangeRateServiceInterface
{
    /**
     * Fetch latest rates from Frankfurter API and update database.
     *
     * @param bool $force Force update even if auto-update setting is disabled
     * @return bool
     */
    public function fetchAndUpdateRates(bool $force = false): bool
    {
        $startTime = microtime(true);

        try {
            // Check auto-update setting unless forced (e.g. manual refresh)
            if (!$force) {
                $autoUpdateSetting = Setting::where('key', 'exchange_rates_auto_update')->value('value');
                if ($autoUpdateSetting === 'false') {
                    Log::info('Exchange rates auto update is disabled in settings.');
                    return false;
                }
            }

            $primaryUrl = config('services.exchange_rates.api_url', 'https://api.frankfurter.dev/v1/latest');
            $fallbackUrl = config('services.exchange_rates.fallback_api_url', 'https://api.frankfurter.app/latest');
            $timeout = (int) config('services.exchange_rates.timeout', 10);
            $sslVerify = (bool) config('services.exchange_rates.ssl_verify', false);

            $urls = array_unique([$primaryUrl, $fallbackUrl]);

            $response = null;
            $lastException = null;
            $statusCode = 0;
            $usedUrl = null;

            // Primary query base currency: USD to easily map USD-cross rates
            $queryParams = ['from' => 'USD'];

            foreach ($urls as $url) {
                try {
                    $usedUrl = $url;
                    $client = Http::timeout($timeout);

                    if (!$sslVerify) {
                        $client = $client->withoutVerifying();
                    }

                    $res = $client->get($url, $queryParams);
                    $statusCode = $res->status();

                    if ($res->successful()) {
                        $jsonData = $res->json();
                        if (is_array($jsonData) && !empty($jsonData['rates'])) {
                            $response = $jsonData;
                            break;
                        } else {
                            $lastException = new \Exception("Unexpected response format from {$url}: missing 'rates' key.");
                        }
                    } else {
                        $lastException = new \Exception("HTTP request to {$url} failed with status {$statusCode}.");
                    }
                } catch (Throwable $e) {
                    $lastException = $e;
                    Log::warning("Frankfurter API attempt failed for {$url}: " . $e->getMessage());
                }
            }

            $responseTimeMs = (int) round((microtime(true) - $startTime) * 1000);

            if (!$response || empty($response['rates'])) {
                $errorMessage = $lastException ? $lastException->getMessage() : 'Unable to retrieve rates from Frankfurter API.';
                
                $this->saveDiagnosticState([
                    'status' => 'failed',
                    'last_failed_sync' => now()->toIso8601String(),
                    'last_error' => $errorMessage,
                    'last_response_code' => $statusCode,
                    'last_response_time' => $responseTimeMs,
                    'cache_status' => Cache::has('exchange_rates_last_api_response') ? 'using_fallback' : 'no_cache',
                ]);

                Log::error("FrankfurterExchangeRateService failed: {$errorMessage}", [
                    'url' => $usedUrl,
                    'status_code' => $statusCode,
                    'response_time_ms' => $responseTimeMs,
                ]);

                return false;
            }

            // Cache raw API response for fallback
            Cache::put('exchange_rates_last_api_response', $response, now()->addDays(7));

            $rates = $response['rates'];

            // Determine USD to BDT base conversion rate
            // Check if existing BDT/USD rate in DB or fallback 120.50
            $usdRecord = ExchangeRate::where('currency_code', 'USD')->first();
            $usdToBdt = $usdRecord && $usdRecord->exchange_rate > 0 ? (float) $usdRecord->exchange_rate : 120.50;

            // Currencies to process
            $currencies = ExchangeRate::all();

            foreach ($currencies as $currency) {
                $code = strtoupper($currency->currency_code);
                $calculatedRate = null;

                if ($code === 'BDT') {
                    $calculatedRate = 1.0000;
                } elseif ($code === 'USD') {
                    $calculatedRate = round($usdToBdt, 4);
                } elseif (isset($rates[$code]) && (float) $rates[$code] > 0) {
                    // Currency code returned by Frankfurter (e.g., EUR, GBP, CAD, AUD, JPY, CNY, INR, MYR, SGD)
                    // rates[code] is 1 USD in units of code X. So 1 X in BDT = usdToBdt / rates[code]
                    $usdToX = (float) $rates[$code];
                    $calculatedRate = round($usdToBdt / $usdToX, 4);
                } elseif ($code === 'SAR') {
                    // SAR is officially pegged to USD at 3.75 SAR per USD
                    $calculatedRate = round($usdToBdt / 3.75, 4);
                } elseif ($code === 'AED') {
                    // AED is officially pegged to USD at 3.6725 AED per USD
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

            // Save success diagnostics
            $this->saveDiagnosticState([
                'status' => 'success',
                'last_successful_sync' => now()->toIso8601String(),
                'last_error' => null,
                'last_response_code' => $statusCode > 0 ? $statusCode : 200,
                'last_response_time' => $responseTimeMs,
                'cache_status' => 'fresh',
            ]);

            // Update timestamp setting
            Setting::updateOrCreate(
                ['key' => 'exchange_rates_last_updated_at'],
                ['value' => now()->toIso8601String()]
            );

            Log::info("FrankfurterExchangeRateService successfully updated exchange rates in {$responseTimeMs}ms from {$usedUrl}.");

            return true;
        } catch (Throwable $e) {
            $responseTimeMs = (int) round((microtime(true) - $startTime) * 1000);
            $errorMessage = $e->getMessage();

            $this->saveDiagnosticState([
                'status' => 'failed',
                'last_failed_sync' => now()->toIso8601String(),
                'last_error' => $errorMessage,
                'last_response_code' => 0,
                'last_response_time' => $responseTimeMs,
                'cache_status' => Cache::has('exchange_rates_last_api_response') ? 'using_fallback' : 'no_cache',
            ]);

            Log::error('FrankfurterExchangeRateService unexpected exception: ' . $errorMessage, ['exception' => $e]);

            return false;
        }
    }

    /**
     * Get real-time diagnostic info for CMS.
     *
     * @return array
     */
    public function getDiagnostics(): array
    {
        $settings = Setting::where('key', 'like', 'exchange_rates_%')->pluck('value', 'key');

        return [
            'provider' => 'Frankfurter API',
            'api_url' => config('services.exchange_rates.api_url', 'https://api.frankfurter.dev/v1/latest'),
            'status' => $settings->get('exchange_rates_status', 'unknown'),
            'last_successful_sync' => $settings->get('exchange_rates_last_successful_sync'),
            'last_failed_sync' => $settings->get('exchange_rates_last_failed_sync'),
            'last_error' => $settings->get('exchange_rates_last_error'),
            'last_response_code' => $settings->get('exchange_rates_last_response_code'),
            'last_response_time' => $settings->get('exchange_rates_last_response_time'),
            'cache_status' => $settings->get('exchange_rates_cache_status', 'fresh'),
            'ssl_verify' => config('services.exchange_rates.ssl_verify', false),
        ];
    }

    /**
     * Test connection to a specific provider.
     */
    public function testProviderConnection(string $providerKey): array
    {
        return app(ExchangeRateManager::class)->testProviderConnection($providerKey);
    }

    /**
     * Helper to save diagnostic settings.
     *
     * @param array $data
     */
    protected function saveDiagnosticState(array $data): void
    {
        Setting::updateOrCreate(['key' => 'exchange_rates_current_provider'], ['value' => 'Frankfurter API']);

        foreach ($data as $key => $val) {
            Setting::updateOrCreate(
                ['key' => 'exchange_rates_' . $key],
                ['value' => $val !== null ? (string) $val : '']
            );
        }
    }
}
