<?php

namespace App\Services;

interface ExchangeRateServiceInterface
{
    /**
     * Fetch latest rates from external API provider and update database.
     *
     * @param bool $force Force update even if auto-update setting is disabled
     * @return bool
     */
    public function fetchAndUpdateRates(bool $force = false): bool;

    /**
     * Get real-time diagnostic information about the exchange rate API service.
     *
     * @return array
     */
    public function getDiagnostics(): array;

    /**
     * Test connection to a specific exchange rate provider independently.
     *
     * @param string $providerKey
     * @return array
     */
    public function testProviderConnection(string $providerKey): array;
}

