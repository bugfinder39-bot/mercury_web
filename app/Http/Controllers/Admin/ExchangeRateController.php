<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExchangeRate;
use App\Models\Section;
use App\Models\Setting;
use App\Services\ExchangeRateServiceInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class ExchangeRateController extends Controller
{
    protected ExchangeRateServiceInterface $exchangeRateService;

    public function __construct(ExchangeRateServiceInterface $exchangeRateService)
    {
        $this->exchangeRateService = $exchangeRateService;
    }

    /**
     * Display listing of exchange rates and section settings.
     */
    public function index(Request $request): Response
    {
        $query = ExchangeRate::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('currency_code', 'like', "%{$search}%")
                  ->orWhere('currency_name', 'like', "%{$search}%")
                  ->orWhere('symbol', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $status = $request->input('status');
            if ($status === 'active') {
                $query->where('is_active', true);
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Source filter
        if ($request->filled('source')) {
            $source = $request->input('source');
            if ($source === 'manual') {
                $query->where('is_manual', true);
            } elseif ($source === 'live') {
                $query->where('is_manual', false);
            }
        }

        $currencies = $query->orderBy('order')->orderBy('id', 'asc')->get();

        $section = Section::where('type', 'exchange_rates')->first();

        // Module settings
        $settings = Setting::where('key', 'like', 'exchange_rates_%')->pluck('value', 'key');

        return Inertia::render('Admin/ExchangeRates/Index', [
            'currencies' => $currencies,
            'filters' => $request->only(['search', 'status', 'source']),
            'section' => $section,
            'settings' => $settings,
            'diagnostics' => $this->exchangeRateService->getDiagnostics(),
            'maxOrder' => (ExchangeRate::max('order') ?? 0) + 1,
        ]);
    }

    /**
     * Store a newly created currency rate in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'currency_code' => 'required|string|max:10|unique:exchange_rates,currency_code',
            'currency_name' => 'required|string|max:255',
            'symbol' => 'required|string|max:10',
            'flag' => 'required|string|max:255',
            'exchange_rate' => 'required|numeric|min:0',
            'is_manual' => 'required|boolean',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $validated['currency_code'] = strtoupper($validated['currency_code']);
        $validated['live_rate'] = $validated['exchange_rate'];
        $validated['source'] = $validated['is_manual'] ? 'manual' : 'live';
        if ($validated['is_manual']) {
            $validated['manual_rate'] = $validated['exchange_rate'];
        }
        $validated['last_updated_at'] = now();

        ExchangeRate::create($validated);

        return redirect()->route('admin.exchange-rates.index')->with('success', 'Currency rate added successfully.');
    }

    /**
     * Update the specified currency rate in storage.
     */
    public function update(Request $request, ExchangeRate $exchangeRate): RedirectResponse
    {
        $validated = $request->validate([
            'currency_code' => 'required|string|max:10|unique:exchange_rates,currency_code,' . $exchangeRate->id,
            'currency_name' => 'required|string|max:255',
            'symbol' => 'required|string|max:10',
            'flag' => 'required|string|max:255',
            'exchange_rate' => 'required|numeric|min:0',
            'is_manual' => 'required|boolean',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $validated['currency_code'] = strtoupper($validated['currency_code']);

        // Check rate modification
        if ($validated['is_manual']) {
            $validated['manual_rate'] = $validated['exchange_rate'];
            $validated['source'] = 'manual';
        } else {
            $validated['source'] = 'live';
        }

        if ($exchangeRate->exchange_rate != $validated['exchange_rate']) {
            $validated['previous_rate'] = $exchangeRate->exchange_rate;
            $validated['last_updated_at'] = now();
        }

        $exchangeRate->update($validated);

        return redirect()->route('admin.exchange-rates.index')->with('success', 'Currency rate updated successfully.');
    }

    /**
     * Remove the specified currency rate from storage.
     */
    public function destroy(ExchangeRate $exchangeRate): RedirectResponse
    {
        $exchangeRate->delete();

        return redirect()->route('admin.exchange-rates.index')->with('success', 'Currency rate deleted successfully.');
    }

    /**
     * Trigger manual live rates update from active API provider.
     */
    public function refreshRates(): RedirectResponse
    {
        $success = $this->exchangeRateService->fetchAndUpdateRates(true);
        $diagnostics = $this->exchangeRateService->getDiagnostics();

        if ($success) {
            $providerName = $diagnostics['current_provider'] ?? 'API';
            return redirect()->back()->with('success', "Live exchange rates updated successfully from {$providerName}.");
        }

        $reason = !empty($diagnostics['last_error']) ? ' (' . $diagnostics['last_error'] . ')' : '';

        return redirect()->back()->with('error', "Failed to fetch live rates from API{$reason}. Using last known market rates.");
    }

    /**
     * Test connection to a specific provider without updating rates database.
     */
    public function testConnection(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'provider_key' => 'required|string',
        ]);

        $result = $this->exchangeRateService->testProviderConnection($validated['provider_key']);

        return response()->json($result);
    }

    /**
     * Toggle active status.
     */
    public function toggleStatus(ExchangeRate $exchangeRate): RedirectResponse
    {
        $exchangeRate->update([
            'is_active' => !$exchangeRate->is_active,
        ]);

        return redirect()->back()->with('success', "Status for {$exchangeRate->currency_code} updated.");
    }

    /**
     * Toggle manual mode.
     */
    public function toggleManual(Request $request, ExchangeRate $exchangeRate): RedirectResponse
    {
        $request->validate([
            'manual_rate' => 'nullable|numeric|min:0',
        ]);

        $isManual = !$exchangeRate->is_manual;

        if ($isManual) {
            $manualRate = $request->input('manual_rate') ?? $exchangeRate->exchange_rate;
            $exchangeRate->update([
                'is_manual' => true,
                'manual_rate' => $manualRate,
                'previous_rate' => $exchangeRate->exchange_rate,
                'exchange_rate' => $manualRate,
                'source' => 'manual',
                'last_updated_at' => now(),
            ]);
        } else {
            $liveRate = $exchangeRate->live_rate ?? $exchangeRate->exchange_rate;
            $exchangeRate->update([
                'is_manual' => false,
                'previous_rate' => $exchangeRate->exchange_rate,
                'exchange_rate' => $liveRate,
                'source' => 'live',
                'last_updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', "Manual mode updated for {$exchangeRate->currency_code}.");
    }

    /**
     * Restore live rate from API.
     */
    public function restoreLive(ExchangeRate $exchangeRate): RedirectResponse
    {
        $liveRate = $exchangeRate->live_rate ?? $exchangeRate->exchange_rate;

        $exchangeRate->update([
            'is_manual' => false,
            'previous_rate' => $exchangeRate->exchange_rate,
            'exchange_rate' => $liveRate,
            'source' => 'live',
            'last_updated_at' => now(),
        ]);

        return redirect()->back()->with('success', "Restored live rate for {$exchangeRate->currency_code}.");
    }

    /**
     * Reorder currencies.
     */
    public function reorder(Request $request): RedirectResponse
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:exchange_rates,id',
            'items.*.order' => 'required|integer',
        ]);

        foreach ($request->input('items') as $item) {
            ExchangeRate::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return redirect()->back()->with('success', 'Exchange rates reordered successfully.');
    }

    /**
     * Update section settings & module configuration.
     */
    public function updateSettings(Request $request): RedirectResponse
    {
        $validatedSection = $request->validate([
            'heading' => 'required|string|max:255',
            'subheading' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $section = Section::where('type', 'exchange_rates')->first();
        if ($section) {
            $section->update($validatedSection);
        }

        $validatedSettings = $request->validate([
            'exchange_rates_enabled' => 'required|string',
            'exchange_rates_active_provider' => 'required|string',
            'exchange_rates_enable_auto_failover' => 'required|string',
            'exchange_rates_auto_update' => 'required|string',
            'exchange_rates_base_currency' => 'required|string',
            'exchange_rates_auto_refresh_interval' => 'required|string',
            'exchange_rates_api_timeout' => 'required|numeric',
            'exchange_rates_retry_attempts' => 'required|numeric',
            'exchange_rates_cache_duration' => 'required|numeric',
            'exchange_rates_enable_logging' => 'required|string',
            'exchange_rates_bg_style' => 'required|string',
            'exchange_rates_animation_style' => 'required|string',
            'exchange_rates_homepage_visibility' => 'required|string',
            'exchange_rates_footer_visibility' => 'required|string',
            'exchange_rates_sidebar_visibility' => 'required|string',
            'exchange_rates_dedicated_page' => 'required|string',
        ]);

        foreach ($validatedSettings as $key => $val) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => (string) $val]
            );
        }

        return redirect()->back()->with('success', 'Exchange rates multi-provider settings updated successfully.');
    }
}
