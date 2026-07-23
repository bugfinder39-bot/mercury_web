<?php

namespace Tests\Feature;

use App\Models\ExchangeRate;
use App\Models\Setting;

use App\Models\User;
use App\Services\ExchangeRateManager;
use App\Services\Providers\FawazAhmedExchangeRateProvider;
use App\Services\Providers\FrankfurterExchangeRateProvider;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ExchangeRateMultiProviderTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        ExchangeRate::firstOrCreate(['currency_code' => 'USD'], [
            'currency_name' => 'US Dollar',
            'symbol' => '$',
            'flag' => '🇺🇸',
            'exchange_rate' => 120.50,
            'is_manual' => false,
            'source' => 'live',
            'order' => 1,
            'is_active' => true,
        ]);

        ExchangeRate::firstOrCreate(['currency_code' => 'EUR'], [
            'currency_name' => 'Euro',
            'symbol' => '€',
            'flag' => '🇪🇺',
            'exchange_rate' => 130.00,
            'is_manual' => false,
            'source' => 'live',
            'order' => 2,
            'is_active' => true,
        ]);

        $page = \App\Models\Page::first() ?? \App\Models\Page::create([
            'name' => 'Home',
            'slug' => 'home',
            'is_active' => true,
        ]);

        \App\Models\Section::firstOrCreate(['type' => 'exchange_rates'], [
            'page_id' => $page->id,
            'heading' => 'Exchange Rates',
            'is_active' => true,
        ]);
    }

    public function test_frankfurter_provider_fetches_and_normalizes_rates()
    {
        Http::fake([
            'api.frankfurter.dev/*' => Http::response([
                'amount' => 1.0,
                'base' => 'USD',
                'date' => '2026-07-24',
                'rates' => [
                    'EUR' => 0.92,
                    'BDT' => 120.5,
                ],
            ], 200),
        ]);

        $provider = new FrankfurterExchangeRateProvider();
        $result = $provider->fetchRates('USD', 5, false);

        $this->assertNotNull($result);
        $this->assertEquals('Frankfurter API', $result['provider']);
        $this->assertEquals(120.5, $result['rates']['BDT']);
        $this->assertEquals(0.92, $result['rates']['EUR']);
    }

    public function test_fawaz_ahmed_provider_fetches_and_normalizes_rates()
    {
        Http::fake([
            'cdn.jsdelivr.net/*' => Http::response([
                'date' => '2026-07-24',
                'usd' => [
                    'bdt' => 120.5,
                    'eur' => 0.92,
                ],
            ], 200),
        ]);

        $provider = new FawazAhmedExchangeRateProvider();
        $result = $provider->fetchRates('USD', 5, false);

        $this->assertNotNull($result);
        $this->assertEquals('Fawaz Ahmed Currency API', $result['provider']);
        $this->assertEquals(120.5, $result['rates']['BDT']);
        $this->assertEquals(0.92, $result['rates']['EUR']);
    }

    public function test_manager_uses_active_provider_setting()
    {
        Setting::updateOrCreate(['key' => 'exchange_rates_active_provider'], ['value' => 'fawaz_ahmed']);

        Http::fake([
            'cdn.jsdelivr.net/*' => Http::response([
                'date' => '2026-07-24',
                'usd' => [
                    'bdt' => 121.0,
                    'eur' => 0.91,
                ],
            ], 200),
        ]);

        $manager = new ExchangeRateManager();
        $this->assertEquals('fawaz_ahmed', $manager->getActiveProviderKey());

        $success = $manager->fetchAndUpdateRates(true);
        $this->assertTrue($success);

        $diagnostics = $manager->getDiagnostics();
        $this->assertEquals('Fawaz Ahmed Currency API', $diagnostics['current_provider']);
    }

    public function test_manager_automatic_failover_when_primary_fails()
    {
        Setting::updateOrCreate(['key' => 'exchange_rates_active_provider'], ['value' => 'frankfurter']);
        Setting::updateOrCreate(['key' => 'exchange_rates_enable_auto_failover'], ['value' => 'true']);

        Http::fake([
            'api.frankfurter.dev/*' => Http::response('Server Error', 500),
            'api.frankfurter.app/*' => Http::response('Server Error', 500),
            'cdn.jsdelivr.net/*' => Http::response([
                'date' => '2026-07-24',
                'usd' => [
                    'bdt' => 120.5,
                    'eur' => 0.92,
                ],
            ], 200),
        ]);

        $manager = new ExchangeRateManager();
        $success = $manager->fetchAndUpdateRates(true);

        $this->assertTrue($success);
        $diagnostics = $manager->getDiagnostics();
        $this->assertEquals('Fawaz Ahmed Currency API', $diagnostics['current_provider']);
    }

    public function test_test_connection_returns_diagnostic_result()
    {
        Http::fake([
            'cdn.jsdelivr.net/*' => Http::response([
                'date' => '2026-07-24',
                'usd' => [
                    'bdt' => 120.5,
                ],
            ], 200),
        ]);

        $manager = new ExchangeRateManager();
        $result = $manager->testProviderConnection('fawaz_ahmed');

        $this->assertTrue($result['success']);
        $this->assertEquals('Fawaz Ahmed Currency API', $result['provider']);
    }

    public function test_admin_can_update_provider_settings_via_http()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put(route('admin.exchange-rates.settings.update'), [
            'heading' => 'Updated Exchange Rates',
            'subheading' => 'SUBHEADING',
            'body' => 'Description text',
            'is_active' => 1,
            'exchange_rates_enabled' => 'true',
            'exchange_rates_active_provider' => 'fawaz_ahmed',
            'exchange_rates_enable_auto_failover' => 'true',
            'exchange_rates_auto_update' => 'true',
            'exchange_rates_base_currency' => 'BDT',
            'exchange_rates_auto_refresh_interval' => '1_hour',
            'exchange_rates_api_timeout' => 10,
            'exchange_rates_retry_attempts' => 2,
            'exchange_rates_cache_duration' => 10080,
            'exchange_rates_enable_logging' => 'true',
            'exchange_rates_bg_style' => 'dark_navy',
            'exchange_rates_animation_style' => 'fade_up',
            'exchange_rates_homepage_visibility' => 'true',
            'exchange_rates_footer_visibility' => 'true',
            'exchange_rates_sidebar_visibility' => 'false',
            'exchange_rates_dedicated_page' => 'true',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('settings', [
            'key' => 'exchange_rates_active_provider',
            'value' => 'fawaz_ahmed',
        ]);
    }
}
