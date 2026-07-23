<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->string('currency_code', 10)->unique();
            $table->string('currency_name');
            $table->string('symbol', 10)->default('$');
            $table->string('flag')->default('🇺🇸');
            $table->decimal('exchange_rate', 14, 4)->default(1.0000);
            $table->decimal('previous_rate', 14, 4)->nullable();
            $table->decimal('live_rate', 14, 4)->nullable();
            $table->decimal('manual_rate', 14, 4)->nullable();
            $table->boolean('is_manual')->default(false);
            $table->string('source', 20)->default('live');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamp('last_updated_at')->nullable();
            $table->timestamps();
        });

        // Seed initial homepage section for exchange rates if not exists
        $homePageId = DB::table('pages')->where('slug', 'home')->value('id');
        if ($homePageId) {
            $maxOrder = DB::table('sections')->where('page_id', $homePageId)->max('order') ?? 0;
            DB::table('sections')->insert([
                'page_id' => $homePageId,
                'type' => 'exchange_rates',
                'heading' => 'Live Global Exchange Rates',
                'subheading' => 'REAL-TIME CURRENCY MARKET DATA',
                'body' => 'Stay informed with live currency exchange rates updated directly from international financial market APIs, featuring custom market overrides and instant currency conversion calculations.',
                'order' => $maxOrder + 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Default initial currencies relative to BDT (Bangladesh Taka)
        $defaultCurrencies = [
            [
                'currency_code' => 'USD',
                'currency_name' => 'US Dollar',
                'symbol' => '$',
                'flag' => '🇺🇸',
                'exchange_rate' => 120.5000,
                'previous_rate' => 120.2000,
                'live_rate' => 120.5000,
                'order' => 1,
                'is_active' => true,
                'last_updated_at' => now(),
            ],
            [
                'currency_code' => 'EUR',
                'currency_name' => 'Euro',
                'symbol' => '€',
                'flag' => '🇪🇺',
                'exchange_rate' => 131.2000,
                'previous_rate' => 131.5000,
                'live_rate' => 131.2000,
                'order' => 2,
                'is_active' => true,
                'last_updated_at' => now(),
            ],
            [
                'currency_code' => 'GBP',
                'currency_name' => 'British Pound',
                'symbol' => '£',
                'flag' => '🇬🇧',
                'exchange_rate' => 155.8000,
                'previous_rate' => 155.0000,
                'live_rate' => 155.8000,
                'order' => 3,
                'is_active' => true,
                'last_updated_at' => now(),
            ],
            [
                'currency_code' => 'SAR',
                'currency_name' => 'Saudi Riyal',
                'symbol' => '﷼',
                'flag' => '🇸🇦',
                'exchange_rate' => 32.1000,
                'previous_rate' => 32.1000,
                'live_rate' => 32.1000,
                'order' => 4,
                'is_active' => true,
                'last_updated_at' => now(),
            ],
            [
                'currency_code' => 'AED',
                'currency_name' => 'UAE Dirham',
                'symbol' => 'د.إ',
                'flag' => '🇦🇪',
                'exchange_rate' => 32.8000,
                'previous_rate' => 32.7500,
                'live_rate' => 32.8000,
                'order' => 5,
                'is_active' => true,
                'last_updated_at' => now(),
            ],
            [
                'currency_code' => 'SGD',
                'currency_name' => 'Singapore Dollar',
                'symbol' => 'S$',
                'flag' => '🇸🇬',
                'exchange_rate' => 90.4000,
                'previous_rate' => 90.1000,
                'live_rate' => 90.4000,
                'order' => 6,
                'is_active' => true,
                'last_updated_at' => now(),
            ],
            [
                'currency_code' => 'MYR',
                'currency_name' => 'Malaysian Ringgit',
                'symbol' => 'RM',
                'flag' => '🇲🇾',
                'exchange_rate' => 27.3000,
                'previous_rate' => 27.4000,
                'live_rate' => 27.3000,
                'order' => 7,
                'is_active' => true,
                'last_updated_at' => now(),
            ],
            [
                'currency_code' => 'CAD',
                'currency_name' => 'Canadian Dollar',
                'symbol' => 'C$',
                'flag' => '🇨🇦',
                'exchange_rate' => 88.5000,
                'previous_rate' => 88.2000,
                'live_rate' => 88.5000,
                'order' => 8,
                'is_active' => true,
                'last_updated_at' => now(),
            ],
            [
                'currency_code' => 'AUD',
                'currency_name' => 'Australian Dollar',
                'symbol' => 'A$',
                'flag' => '🇦🇺',
                'exchange_rate' => 79.2000,
                'previous_rate' => 79.2000,
                'live_rate' => 79.2000,
                'order' => 9,
                'is_active' => true,
                'last_updated_at' => now(),
            ],
            [
                'currency_code' => 'JPY',
                'currency_name' => 'Japanese Yen',
                'symbol' => '¥',
                'flag' => '🇯🇵',
                'exchange_rate' => 0.7800,
                'previous_rate' => 0.7750,
                'live_rate' => 0.7800,
                'order' => 10,
                'is_active' => true,
                'last_updated_at' => now(),
            ],
            [
                'currency_code' => 'CNY',
                'currency_name' => 'Chinese Yuan',
                'symbol' => '¥',
                'flag' => '🇨🇳',
                'exchange_rate' => 16.8000,
                'previous_rate' => 16.8500,
                'live_rate' => 16.8000,
                'order' => 11,
                'is_active' => true,
                'last_updated_at' => now(),
            ],
            [
                'currency_code' => 'INR',
                'currency_name' => 'Indian Rupee',
                'symbol' => '₹',
                'flag' => '🇮🇳',
                'exchange_rate' => 1.4400,
                'previous_rate' => 1.4400,
                'live_rate' => 1.4400,
                'order' => 12,
                'is_active' => true,
                'last_updated_at' => now(),
            ],
        ];

        foreach ($defaultCurrencies as $currency) {
            DB::table('exchange_rates')->insert(array_merge($currency, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Default section settings in settings table
        $defaultSettings = [
            'exchange_rates_enabled' => 'true',
            'exchange_rates_auto_update' => 'true',
            'exchange_rates_base_currency' => 'BDT',
            'exchange_rates_auto_refresh_interval' => '1_hour',
            'exchange_rates_bg_style' => 'dark_navy',
            'exchange_rates_animation_style' => 'fade_up',
            'exchange_rates_homepage_visibility' => 'true',
            'exchange_rates_footer_visibility' => 'true',
            'exchange_rates_sidebar_visibility' => 'false',
            'exchange_rates_dedicated_page' => 'true',
        ];

        foreach ($defaultSettings as $key => $val) {
            DB::table('settings')->updateOrInsert(
                ['key' => $key],
                ['value' => $val, 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_rates');
        DB::table('sections')->where('type', 'exchange_rates')->delete();
        DB::table('settings')->where('key', 'like', 'exchange_rates_%')->delete();
    }
};
