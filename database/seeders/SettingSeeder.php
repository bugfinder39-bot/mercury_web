<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        // General Info
        Setting::create([
            'key' => 'company_name',
            'value' => 'Mercury Bangladesh (Pvt.) Ltd.',
            'group' => 'general',
        ]);

        Setting::create([
            'key' => 'company_tagline',
            'value' => 'Mercury is your better choice for any shipping need',
            'group' => 'general',
        ]);

        Setting::create([
            'key' => 'company_logo',
            'value' => '/images/logo.svg',
            'group' => 'general',
        ]);

        Setting::create([
            'key' => 'company_favicon',
            'value' => '/favicon.ico',
            'group' => 'general',
        ]);

        Setting::create([
            'key' => 'contact_email',
            'value' => 'ops@mercury-bd.com',
            'group' => 'general',
        ]);

        Setting::create([
            'key' => 'contact_phone',
            'value' => '+880 2 9876543',
            'group' => 'general',
        ]);

        Setting::create([
            'key' => 'contact_address',
            'value' => 'House 45, Road 11, Banani, Dhaka-1213, Bangladesh',
            'group' => 'general',
        ]);

        Setting::create([
            'key' => 'office_hours',
            'value' => 'Sunday - Thursday: 09:00 AM - 06:00 PM',
            'group' => 'general',
        ]);

        // Social links
        Setting::create([
            'key' => 'social_linkedin',
            'value' => 'https://www.linkedin.com/company/mercury-bangladesh',
            'group' => 'social',
        ]);

        Setting::create([
            'key' => 'social_facebook',
            'value' => 'https://www.facebook.com/mercurybangladesh',
            'group' => 'social',
        ]);

        // Map configuration
        Setting::create([
            'key' => 'google_maps_embed',
            'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.109722306282!2d90.40263627607144!3d23.779124488344795!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c77095679d71%3A0x6b8ee0b2b8c9d226!2sBanani%20Graveyard!5e0!3m2!1sen!2sbd!4v1719999999999!5m2!1sen!2sbd',
            'group' => 'map',
        ]);

        // Default SEO
        Setting::create([
            'key' => 'default_seo_title',
            'value' => 'Mercury Bangladesh - Premier Corporate Logistics Operations',
            'group' => 'seo',
        ]);

        Setting::create([
            'key' => 'default_seo_description',
            'value' => 'Mercury Bangladesh offers premium sea freight, air freight, warehousing, and customs clearance services to simplify global supply chain challenges.',
            'group' => 'seo',
        ]);

        // Coming Soon mode
        Setting::create([
            'key' => 'coming_soon_enabled',
            'value' => 'false',
            'group' => 'general',
        ]);

        Setting::create([
            'key' => 'coming_soon_target',
            'value' => 'entire_website',
            'group' => 'general',
        ]);
    }
}

