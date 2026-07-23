<?php

namespace App\Services;

class ExchangeRateService implements ExchangeRateServiceInterface
{
    protected ExchangeRateServiceInterface $innerService;

    public function __construct(ExchangeRateServiceInterface $innerService = null)
    {
        $this->innerService = $innerService ?? app(ExchangeRateManager::class);
    }

    /**
     * Fetch latest rates from API and update database.
     */
    public function fetchAndUpdateRates(bool $force = false): bool
    {
        return $this->innerService->fetchAndUpdateRates($force);
    }

    /**
     * Get real-time diagnostic information.
     */
    public function getDiagnostics(): array
    {
        return $this->innerService->getDiagnostics();
    }

    /**
     * Test connection to a specific provider.
     */
    public function testProviderConnection(string $providerKey): array
    {
        return $this->innerService->testProviderConnection($providerKey);
    }
}
