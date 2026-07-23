<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $settings = [
            ['key' => 'show_navbar', 'value' => 'false', 'group' => 'coming_soon'],
            ['key' => 'show_footer', 'value' => 'false', 'group' => 'coming_soon'],
            ['key' => 'coming_soon_show_navbar', 'value' => 'false', 'group' => 'coming_soon'],
            ['key' => 'coming_soon_show_footer', 'value' => 'false', 'group' => 'coming_soon'],
            ['key' => 'footer_phones', 'value' => '[]', 'group' => 'layout'],
            ['key' => 'footer_emails', 'value' => '[]', 'group' => 'layout'],
            ['key' => 'footer_addresses', 'value' => '[]', 'group' => 'layout'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'group' => $setting['group'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $keys = [
            'show_navbar',
            'show_footer',
            'coming_soon_show_navbar',
            'coming_soon_show_footer',
            'footer_phones',
            'footer_emails',
            'footer_addresses',
        ];

        DB::table('settings')->whereIn('key', $keys)->delete();
    }
};
