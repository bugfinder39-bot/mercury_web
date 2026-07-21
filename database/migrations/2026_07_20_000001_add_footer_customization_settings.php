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
            ['key' => 'footer_bg_style', 'value' => 'solid-white', 'group' => 'layout'],
            ['key' => 'footer_paragraph_color', 'value' => '#475569', 'group' => 'layout'],
            ['key' => 'footer_secondary_text_color', 'value' => '#94A3B8', 'group' => 'layout'],
            ['key' => 'footer_quick_links_color', 'value' => '#475569', 'group' => 'layout'],
            ['key' => 'footer_quick_links_hover_color', 'value' => '#E8770C', 'group' => 'layout'],
            ['key' => 'footer_services_links_color', 'value' => '#475569', 'group' => 'layout'],
            ['key' => 'footer_services_hover_color', 'value' => '#E8770C', 'group' => 'layout'],
            ['key' => 'footer_newsletter_heading_color', 'value' => '#0B2540', 'group' => 'layout'],
            ['key' => 'footer_newsletter_description_color', 'value' => '#475569', 'group' => 'layout'],
            ['key' => 'footer_bottom_tagline_color', 'value' => '#E8770C', 'group' => 'layout'],
            ['key' => 'footer_icon_style', 'value' => 'circle', 'group' => 'layout'],
            ['key' => 'footer_icon_hover_bg', 'value' => '#E8770C', 'group' => 'layout'],
            ['key' => 'footer_icon_hover_color', 'value' => '#FFFFFF', 'group' => 'layout'],
            ['key' => 'footer_icon_border_color', 'value' => '#E8770C', 'group' => 'layout'],
            ['key' => 'footer_icon_shadow', 'value' => 'light', 'group' => 'layout'],
            ['key' => 'footer_newsletter_input_bg', 'value' => '#F8FAFC', 'group' => 'layout'],
            ['key' => 'footer_newsletter_input_border', 'value' => '#F1F5F9', 'group' => 'layout'],
            ['key' => 'footer_newsletter_input_text_color', 'value' => '#475569', 'group' => 'layout'],
            ['key' => 'footer_newsletter_placeholder_color', 'value' => '#94A3B8', 'group' => 'layout'],
            ['key' => 'footer_newsletter_btn_hover_bg', 'value' => '#CC6608', 'group' => 'layout'],
            ['key' => 'footer_newsletter_btn_hover_text_color', 'value' => '#FFFFFF', 'group' => 'layout'],
            ['key' => 'footer_newsletter_btn_shadow', 'value' => 'light', 'group' => 'layout'],
            ['key' => 'footer_divider_style', 'value' => 'thin-accent', 'group' => 'layout'],
            ['key' => 'footer_social_icon_bg', 'value' => '#F8FAFC', 'group' => 'layout'],
            ['key' => 'footer_social_icon_color', 'value' => '#123A5E', 'group' => 'layout'],
            ['key' => 'footer_social_hover_bg', 'value' => '#E8770C', 'group' => 'layout'],
            ['key' => 'footer_social_hover_color', 'value' => '#FFFFFF', 'group' => 'layout'],
            ['key' => 'footer_social_border_color', 'value' => 'transparent', 'group' => 'layout'],
            ['key' => 'footer_social_shadow', 'value' => 'light', 'group' => 'layout'],
            ['key' => 'footer_column_gap', 'value' => '3rem', 'group' => 'layout'],
            ['key' => 'footer_section_gap', 'value' => '4rem', 'group' => 'layout'],
            ['key' => 'footer_link_hover_effect', 'value' => 'underline', 'group' => 'layout'],
            ['key' => 'footer_animation_style', 'value' => 'none', 'group' => 'layout'],
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
            'footer_bg_style', 'footer_paragraph_color', 'footer_secondary_text_color',
            'footer_quick_links_color', 'footer_quick_links_hover_color', 'footer_services_links_color',
            'footer_services_hover_color', 'footer_newsletter_heading_color', 'footer_newsletter_description_color',
            'footer_bottom_tagline_color', 'footer_icon_style', 'footer_icon_hover_bg',
            'footer_icon_hover_color', 'footer_icon_border_color', 'footer_icon_shadow',
            'footer_newsletter_input_bg', 'footer_newsletter_input_border', 'footer_newsletter_input_text_color',
            'footer_newsletter_placeholder_color', 'footer_newsletter_btn_hover_bg', 'footer_newsletter_btn_hover_text_color',
            'footer_newsletter_btn_shadow', 'footer_divider_style', 'footer_social_icon_bg',
            'footer_social_icon_color', 'footer_social_hover_bg', 'footer_social_hover_color',
            'footer_social_border_color', 'footer_social_shadow', 'footer_column_gap',
            'footer_section_gap', 'footer_link_hover_effect', 'footer_animation_style'
        ];

        DB::table('settings')->whereIn('key', $keys)->delete();
    }
};
