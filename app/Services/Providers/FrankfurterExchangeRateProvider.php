<?php

namespace App\Services\Providers;

use App\Services\ExchangeRateProviderInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class FrankfurterExchangeRateProvider implements ExchangeRateProviderInterface
{
    public function getKey(): string
    {
        return 'frankfurter';
    }

    public function getName(): string
    {
        return 'Frankfurter API';
    }

    public function getBaseUrl(): string
    {
        return config('services.exchange_rates.providers.frankfurter.api_url', 'https://api.frankfurter.dev/v1/latest');
    }

    public function fetchRates(string $baseCurrency = 'USD', int $timeout = 10, bool $sslVerify = false): ?array
    {
        $primaryUrl = $this->getBaseUrl();
        $fallbackUrl = config('services.exchange_rates.providers.frankfurter.fallback_api_url', 'https://api.frankfurter.app/latest');

        $urls = array_unique([$primaryUrl, $fallbackUrl]);
        $queryParams = ['from' => strtoupper($baseCurrency)];

        foreach ($urls as $url) {
            $startTime = microtime(true);
            try {
                $client = Http::timeout($timeout);
                if (!$sslVerify) {
                    $client = $client->withoutVerifying();
                }

                $response = $client->get($url, $queryParams);
                $responseTimeMs = (int) round((microtime(true) - $startTime) * 1000);

                if ($response->successful()) {
                    $jsonData = $response->json();
                    if (is_array($jsonData) && !empty($jsonData['rates']) && is_array($jsonData['rates'])) {
                        // Normalize rate keys to uppercase
                        $normalizedRates = [];
                        foreach ($jsonData['rates'] as $code => $rate) {
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

                Log::warning("FrankfurterExchangeRateProvider attempt unsuccessful for {$url}", [
                    'status' => $response->status(),
                    'body' => substr($response->body(), 0, 500),
                ]);
            } catch (Throwable $e) {
                Log::warning("FrankfurterExchangeRateProvider exception for {$url}: " . $e->getMessage());
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

            $response = $client->get($url, ['from' => 'USD']);
            $responseTimeMs = (int) round((microtime(true) - $startTime) * 1000);

            if ($response->successful()) {
                $jsonData = $response->json();
                if (is_array($jsonData) && !empty($jsonData['rates'])) {
                    return [
                        'success' => true,
                        'provider' => $this->getName(),
                        'provider_key' => $this->getKey(),
                        'url' => $url,
                        'status_code' => $response->status(),
                        'response_time_ms' => $responseTimeMs,
                        'message' => "Successfully connected to Frankfurter API in {$responseTimeMs}ms.",
                        'sample_rate' => isset($jsonData['rates']['EUR']) ? "1 USD = {$jsonData['rates']['EUR']} EUR" : null,
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
                'message' => "Frankfurter API returned HTTP {$response->status()} with unexpected body structure.",
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
                'message' => "Failed to connect to Frankfurter API: " . $e->getMessage(),
                'error_detail' => $e->getMessage(),
            ];
        }
    }
}
