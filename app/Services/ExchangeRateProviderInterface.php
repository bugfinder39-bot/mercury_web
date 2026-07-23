<?php

namespace App\Services;

interface ExchangeRateProviderInterface
{
    /**
     * Get unique provider identifier key (e.g. 'frankfurter', 'fawaz_ahmed').
     */
    public function getKey(): string;

    /**
     * Get human readable provider display name.
     */
    public function getName(): string;

    /**
     * Get primary provider base URL.
     */
    public function getBaseUrl(): string;

    /**
     * Fetch latest rates array from external API.
     * Returns array with keys ['rates' => [...], 'base' => 'USD', 'url' => '...'], or null on failure.
     *
     * @param string $baseCurrency
     * @param int $timeout
     * @param bool $sslVerify
     * @return array|null
     */
    public function fetchRates(string $baseCurrency = 'USD', int $timeout = 10, bool $sslVerify = false): ?array;

    /**
     * Test connection to provider without modifying production database.
     *
     * @param int $timeout
     * @param bool $sslVerify
     * @return array
     */
    public function testConnection(int $timeout = 5, bool $sslVerify = false): array;
}
