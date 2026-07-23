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
        // 1. Fetch current settings
        $settings = DB::table('settings')->pluck('value', 'key')->all();

        // 2. Consolidate Phone Numbers into footer_phones
        $footerPhones = [];
        if (!empty($settings['footer_phones'])) {
            $decoded = json_decode($settings['footer_phones'], true);
            if (is_array($decoded) && count($decoded) > 0) {
                $footerPhones = $decoded;
            }
        }

        if (empty($footerPhones)) {
            $singlePhone = $settings['footer_phone'] ?? $settings['contact_phone'] ?? '+880 2 9876543';
            $footerPhones = [
                ['phone' => $singlePhone, 'label' => 'Head Office', 'is_active' => true],
                ['phone' => '+880 1700 000000', 'label' => '24/7 Hotline', 'is_active' => true],
            ];
        }

        // 3. Consolidate Email Addresses into footer_emails
        $footerEmails = [];
        if (!empty($settings['footer_emails'])) {
            $decoded = json_decode($settings['footer_emails'], true);
            if (is_array($decoded) && count($decoded) > 0) {
                $footerEmails = $decoded;
            }
        }

        if (empty($footerEmails)) {
            $singleEmail = $settings['footer_email'] ?? $settings['contact_email'] ?? 'ops@mercury-bd.com';
            $footerEmails = [
                ['email' => $singleEmail, 'label' => 'Operations', 'is_active' => true],
                ['email' => 'cs@mercury-bd.com', 'label' => 'Customer Support', 'is_active' => true],
            ];
        }

        // 4. Consolidate Office Addresses into footer_addresses
        $footerAddresses = [];
        if (!empty($settings['footer_addresses'])) {
            $decoded = json_decode($settings['footer_addresses'], true);
            if (is_array($decoded) && count($decoded) > 0) {
                $footerAddresses = $decoded;
            }
        }

        if (empty($footerAddresses)) {
            $singleAddress = $settings['footer_address'] ?? $settings['contact_address'] ?? 'House 45, Road 11, Banani, Dhaka-1213, Bangladesh';
            $mapUrl = $settings['google_maps_embed'] ?? '';
            $footerAddresses = [
                [
                    'name' => 'Corporate Office',
                    'address' => $singleAddress,
                    'map_url' => $mapUrl,
                    'is_active' => true,
                ],
            ];
        }

        // 5. Update settings table with consolidated repeatable JSON strings
        $consolidatedSettings = [
            ['key' => 'footer_phones', 'value' => json_encode($footerPhones), 'group' => 'layout'],
            ['key' => 'footer_emails', 'value' => json_encode($footerEmails), 'group' => 'layout'],
            ['key' => 'footer_addresses', 'value' => json_encode($footerAddresses), 'group' => 'layout'],
        ];

        foreach ($consolidatedSettings as $item) {
            DB::table('settings')->updateOrInsert(
                ['key' => $item['key']],
                [
                    'value' => $item['value'],
                    'group' => $item['group'],
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
        // No loss of data on rollback needed
    }
};
