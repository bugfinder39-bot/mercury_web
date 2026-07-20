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
            // Navbar
            ['key' => 'navbar_website_name', 'value' => 'MERCURY', 'group' => 'layout'],
            ['key' => 'navbar_website_tagline', 'value' => 'BANGLADESH', 'group' => 'layout'],
            ['key' => 'navbar_logo', 'value' => '/images/logo.svg', 'group' => 'layout'],
            ['key' => 'navbar_links', 'value' => json_encode([
                ['name' => 'Home', 'href' => '/', 'target_blank' => false, 'is_active' => true],
                ['name' => 'About', 'href' => '/about', 'target_blank' => false, 'is_active' => true],
                ['name' => 'Services', 'href' => '/services', 'target_blank' => false, 'is_active' => true],
                ['name' => 'Contact', 'href' => '/contact', 'target_blank' => false, 'is_active' => true]
            ]), 'group' => 'layout'],
            ['key' => 'navbar_cta_text', 'value' => 'Get a Quote', 'group' => 'layout'],
            ['key' => 'navbar_cta_url', 'value' => '/contact', 'group' => 'layout'],
            ['key' => 'navbar_cta_active', 'value' => 'true', 'group' => 'layout'],
            ['key' => 'navbar_style', 'value' => 'glassmorphism', 'group' => 'layout'],
            ['key' => 'navbar_sticky', 'value' => 'true', 'group' => 'layout'],
            ['key' => 'navbar_blur', 'value' => 'true', 'group' => 'layout'],
            ['key' => 'navbar_shadow', 'value' => 'true', 'group' => 'layout'],
            ['key' => 'navbar_border_bottom', 'value' => 'true', 'group' => 'layout'],
            ['key' => 'navbar_bg', 'value' => '#FFFFFF', 'group' => 'layout'],
            ['key' => 'navbar_text', 'value' => '#0B2540', 'group' => 'layout'],
            ['key' => 'navbar_hover', 'value' => '#E8770C', 'group' => 'layout'],
            ['key' => 'navbar_active', 'value' => '#E8770C', 'group' => 'layout'],
            ['key' => 'navbar_cta_bg', 'value' => '#E8770C', 'group' => 'layout'],
            ['key' => 'navbar_cta_text_color', 'value' => '#FFFFFF', 'group' => 'layout'],
            ['key' => 'navbar_cta_hover_bg', 'value' => '#CC6608', 'group' => 'layout'],
            ['key' => 'navbar_cta_hover_text', 'value' => '#FFFFFF', 'group' => 'layout'],
            ['key' => 'navbar_glass_opacity', 'value' => '0.9', 'group' => 'layout'],
            ['key' => 'navbar_glass_blur', 'value' => '12px', 'group' => 'layout'],
            ['key' => 'navbar_border_color', 'value' => 'rgba(226, 232, 240, 0.5)', 'group' => 'layout'],
            ['key' => 'navbar_shadow_strength', 'value' => 'rgba(11, 37, 64, 0.05)', 'group' => 'layout'],
            ['key' => 'navbar_height', 'value' => '72px', 'group' => 'layout'],
            ['key' => 'navbar_font_weight', 'value' => '500', 'group' => 'layout'],

            // Footer
            ['key' => 'footer_logo', 'value' => '/images/logo.svg', 'group' => 'layout'],
            ['key' => 'footer_company_name', 'value' => 'Mercury Bangladesh', 'group' => 'layout'],
            ['key' => 'footer_description', 'value' => 'Your better choice for any shipping and international logistics need.', 'group' => 'layout'],
            ['key' => 'footer_quick_links', 'value' => json_encode([
                ['name' => 'Home', 'href' => '/', 'is_active' => true],
                ['name' => 'About Us', 'href' => '/about', 'is_active' => true],
                ['name' => 'Services', 'href' => '/services', 'is_active' => true],
                ['name' => 'Contact', 'href' => '/contact', 'is_active' => true]
            ]), 'group' => 'layout'],
            ['key' => 'footer_services', 'value' => json_encode([
                ['name' => 'Sea Freight Forwarding', 'href' => '/services', 'is_active' => true],
                ['name' => 'Air Freight Forwarding', 'href' => '/services', 'is_active' => true],
                ['name' => 'Custom House Brokerage', 'href' => '/services', 'is_active' => true],
                ['name' => 'Project Cargo Logistics', 'href' => '/services', 'is_active' => true]
            ]), 'group' => 'layout'],
            ['key' => 'footer_newsletter_title', 'value' => 'Newsletter', 'group' => 'layout'],
            ['key' => 'footer_newsletter_desc', 'value' => 'Subscribe to receive schedule updates, market reports, and rate announcements.', 'group' => 'layout'],
            ['key' => 'footer_newsletter_active', 'value' => 'true', 'group' => 'layout'],
            ['key' => 'footer_socials', 'value' => json_encode([
                ['platform' => 'facebook', 'url' => 'https://www.facebook.com/mercurybangladesh', 'is_active' => true],
                ['platform' => 'linkedin', 'url' => 'https://www.linkedin.com/company/mercury-bangladesh', 'is_active' => true],
                ['platform' => 'instagram', 'url' => '', 'is_active' => false],
                ['platform' => 'youtube', 'url' => '', 'is_active' => false],
                ['platform' => 'twitter', 'url' => '', 'is_active' => false],
                ['platform' => 'whatsapp', 'url' => '', 'is_active' => false]
            ]), 'group' => 'layout'],
            ['key' => 'footer_address', 'value' => 'House 45, Road 11, Banani, Dhaka-1213, Bangladesh', 'group' => 'layout'],
            ['key' => 'footer_phone', 'value' => '+880 2 9876543', 'group' => 'layout'],
            ['key' => 'footer_email', 'value' => 'ops@mercury-bd.com', 'group' => 'layout'],
            ['key' => 'footer_copyright', 'value' => '© 2026 Mercury Bangladesh (Pvt.) Ltd. All rights reserved.', 'group' => 'layout'],
            ['key' => 'footer_tagline', 'value' => 'Precise • Calm • Dependable', 'group' => 'layout'],
            ['key' => 'footer_bg', 'value' => '#FFFFFF', 'group' => 'layout'],
            ['key' => 'footer_text', 'value' => '#475569', 'group' => 'layout'],
            ['key' => 'footer_heading_color', 'value' => '#0B2540', 'group' => 'layout'],
            ['key' => 'footer_link_color', 'value' => '#475569', 'group' => 'layout'],
            ['key' => 'footer_link_hover_color', 'value' => '#E8770C', 'group' => 'layout'],
            ['key' => 'footer_icon_bg', 'value' => '#F8FAFC', 'group' => 'layout'],
            ['key' => 'footer_icon_color', 'value' => '#123A5E', 'group' => 'layout'],
            ['key' => 'footer_border_color', 'value' => '#F1F5F9', 'group' => 'layout'],
            ['key' => 'footer_newsletter_bg', 'value' => '#F8FAFC', 'group' => 'layout'],
            ['key' => 'footer_newsletter_btn_bg', 'value' => '#E8770C', 'group' => 'layout'],
            ['key' => 'footer_newsletter_btn_text', 'value' => '#FFFFFF', 'group' => 'layout'],
            ['key' => 'footer_copyright_color', 'value' => '#94A3B8', 'group' => 'layout'],
            ['key' => 'footer_bottom_bg', 'value' => '#FFFFFF', 'group' => 'layout'],
            ['key' => 'footer_shadow_strength', 'value' => 'rgba(11, 37, 64, 0.05)', 'group' => 'layout'],
            ['key' => 'footer_top_padding', 'value' => '80px', 'group' => 'layout'],
            ['key' => 'footer_bottom_padding', 'value' => '40px', 'group' => 'layout'],
            ['key' => 'footer_font_weight', 'value' => '400', 'group' => 'layout'],

            // Global General Typography & Spacing
            ['key' => 'heading_color', 'value' => '#0B2540', 'group' => 'layout'],
            ['key' => 'paragraph_color', 'value' => '#475569', 'group' => 'layout'],
            ['key' => 'small_text_color', 'value' => '#94A3B8', 'group' => 'layout'],
            ['key' => 'container_width', 'value' => '1280px', 'group' => 'layout'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'group' => $setting['group'], 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $keys = [
            'navbar_website_name', 'navbar_website_tagline', 'navbar_logo', 'navbar_links',
            'navbar_cta_text', 'navbar_cta_url', 'navbar_cta_active', 'navbar_style',
            'navbar_sticky', 'navbar_blur', 'navbar_shadow', 'navbar_border_bottom',
            'navbar_bg', 'navbar_text', 'navbar_hover', 'navbar_active', 'navbar_cta_bg',
            'navbar_cta_text_color', 'navbar_cta_hover_bg', 'navbar_cta_hover_text',
            'navbar_glass_opacity', 'navbar_glass_blur', 'navbar_border_color',
            'navbar_shadow_strength', 'navbar_height', 'navbar_font_weight',
            'footer_logo', 'footer_company_name', 'footer_description', 'footer_quick_links',
            'footer_services', 'footer_newsletter_title', 'footer_newsletter_desc',
            'footer_newsletter_active', 'footer_socials', 'footer_address', 'footer_phone',
            'footer_email', 'footer_copyright', 'footer_tagline', 'footer_bg', 'footer_text',
            'footer_heading_color', 'footer_link_color', 'footer_link_hover_color',
            'footer_icon_bg', 'footer_icon_color', 'footer_border_color', 'footer_newsletter_bg',
            'footer_newsletter_btn_bg', 'footer_newsletter_btn_text', 'footer_copyright_color',
            'footer_bottom_bg', 'footer_shadow_strength', 'footer_top_padding',
            'footer_bottom_padding', 'footer_font_weight', 'heading_color', 'paragraph_color',
            'small_text_color', 'container_width'
        ];

        DB::table('settings')->whereIn('key', $keys)->delete();
    }
};
