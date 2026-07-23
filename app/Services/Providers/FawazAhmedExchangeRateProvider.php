<?php

namespace App\Services\Providers;

use App\Services\ExchangeRateProviderInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class FawazAhmedExchangeRateProvider implements ExchangeRateProviderInterface
{
    public function getKey(): string
    {
        return 'fawaz_ahmed';
    }

    public function getName(): string
    {
        return 'Fawaz Ahmed Currency API';
    }

    public function getBaseUrl(): string
    {
        return config('services.exchange_rates.providers.fawaz_ahmed.api_url', 'https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/usd.json');
    }

    public function fetchRates(string $baseCurrency = 'USD', int $timeout = 10, bool $sslVerify = false): ?array
    {
        $primaryUrl = $this->getBaseUrl();
        $fallbackUrl = config('services.exchange_rates.providers.fawaz_ahmed.fallback_api_url', 'https://latest.currency-api.pages.dev/v1/currencies/usd.json');

        $urls = array_unique([$primaryUrl, $fallbackUrl]);
        $lowerBase = strtolower($baseCurrency);

        foreach ($urls as $baseUrl) {
            // Replace /usd.json in URL if base currency is different, or build URL dynamically
            $url = preg_replace('/\/[a-z0-9_-]+\.json$/i', "/{$lowerBase}.json", $baseUrl);
            if (!$url) {
                $url = $baseUrl;
            }

            $startTime = microtime(true);
            try {
                $client = Http::timeout($timeout);
                if (!$sslVerify) {
                    $client = $client->withoutVerifying();
                }

                $response = $client->get($url);
                $responseTimeMs = (int) round((microtime(true) - $startTime) * 1000);

                if ($response->successful()) {
                    $jsonData = $response->json();
                    if (is_array($jsonData) && !empty($jsonData[$lowerBase]) && is_array($jsonData[$lowerBase])) {
                        $rawRates = $jsonData[$lowerBase];
                        $normalizedRates = [];
                        foreach ($rawRates as $code => $rate) {
                            $normalizedRates[strtoupper($code)] = (float) $rate;
                        }

                        return [
                            'provider' => $this->getName(),
                            'provider_key' => $this->getKey(),
                            'base' => strtoupper($baseCurrency),
                            'rates' => $normalizedRates,
                            'used_url' => $url,
                            'status_code' => $response->status(),
                            'response_time_ms' => $responseTimeMs,
                        ];
                    }
                }

                Log::warning("FawazAhmedExchangeRateProvider attempt unsuccessful for {$url}", [
                    'status' => $response->status(),
                    'body' => substr($response->body(), 0, 500),
                ]);
            } catch (Throwable $e) {
                Log::warning("FawazAhmedExchangeRateProvider exception for {$url}: " . $e->getMessage());
            }
        }

        return null;
    }

    public function testConnection(int $timeout = 5, bool $sslVerify = false): array
    {
        $url = $this->getBaseUrl();
        $startTime = microtime(true);

        try {
            $client = Http::timeout($timeout);
            if (!$sslVerify) {
                $client = $client->withoutVerifying();
            }

            $response = $client->get($url);
            $responseTimeMs = (int) round((microtime(true) - $startTime) * 1000);

            if ($response->successful()) {
                $jsonData = $response->json();
                if (is_array($jsonData) && !empty($jsonData['usd'])) {
                    $rates = $jsonData['usd'];
                    $bdtRate = isset($rates['bdt']) ? $rates['bdt'] : (isset($rates['BDT']) ? $rates['BDT'] : null);
                    $sample = $bdtRate ? "1 USD = {$bdtRate} BDT" : "Connected successfully";

                    return [
                        'success' => true,
                        'provider' => $this->getName(),
                        'provider_key' => $this->getKey(),
                        'url' => $url,
                        'status_code' => $response->status(),
                        'response_time_ms' => $responseTimeMs,
                        'message' => "Successfully connected to Fawaz Ahmed Currency API in {$responseTimeMs}ms.",
                        'sample_rate' => $sample,
                    ];
                }
            }

            return [
                'success' => false,
                'provider' => $this->getName(),
                'provider_key' => $this->getKey(),
                'url' => $url,
                'status_code' => $response->status(),
                'response_time_ms' => $responseTimeMs,
                'message' => "Fawaz Ahmed API returned HTTP {$response->status()} with unexpected body format.",
                'error_detail' => substr($response->body(), 0, 300),
            ];
        } catch (Throwable $e) {
            $responseTimeMs = (int) round((microtime(true) - $startTime) * 1000);
            return [
                'success' => false,
                'provider' => $this->getName(),
                'provider_key' => $this->getKey(),
                'url' => $url,
                'status_code' => 0,
                'response_time_ms' => $responseTimeMs,
                'message' => "Failed to connect to Fawaz Ahmed Currency API: " . $e->getMessage(),
                'error_detail' => $e->getMessage(),
            ];
        }
    }
}
