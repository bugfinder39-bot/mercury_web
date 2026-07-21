<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use App\Services\CmsService;

class LayoutController extends Controller
{
    protected CmsService $cmsService;

    public function __construct(CmsService $cmsService)
    {
        $this->cmsService = $cmsService;
    }

    /**
     * Display layout settings for editing.
     */
    public function edit(): Response
    {
        $settings = $this->cmsService->getAllSettings();

        // Convert JSON strings to array for easier usage in Vue
        $jsonKeys = ['navbar_links', 'footer_quick_links', 'footer_services', 'footer_socials'];
        foreach ($jsonKeys as $key) {
            if (isset($settings[$key]) && is_string($settings[$key])) {
                $settings[$key] = json_decode($settings[$key], true);
            } else {
                $settings[$key] = [];
            }
        }

        return Inertia::render('Admin/Layout/Edit', [
            'settings' => $settings,
        ]);
    }

    /**
     * Update layout settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'settings.navbar_website_name' => 'required|string|max:255',
            'settings.navbar_website_tagline' => 'nullable|string|max:255',
            'settings.navbar_logo' => 'nullable|string|max:255',
            'settings.navbar_links' => 'required|array',
            'settings.navbar_cta_text' => 'nullable|string|max:255',
            'settings.navbar_cta_url' => 'nullable|string|max:255',
            'settings.navbar_cta_active' => 'required|string|in:true,false',
            'settings.navbar_login_button' => 'nullable|string|in:true,false',
            'settings.show_login_button' => 'nullable|string|in:true,false',
            'settings.navbar_style' => 'required|string|in:transparent,solid,glassmorphism',
            'settings.navbar_sticky' => 'required|string|in:true,false',
            'settings.navbar_blur' => 'required|string|in:true,false',
            'settings.navbar_shadow' => 'required|string|in:true,false',
            'settings.navbar_border_bottom' => 'required|string|in:true,false',
            'settings.navbar_bg' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.navbar_text' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.navbar_hover' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.navbar_active' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.navbar_cta_bg' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.navbar_cta_text_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.navbar_cta_hover_bg' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.navbar_cta_hover_text' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.navbar_glass_opacity' => 'required|numeric|between:0,1',
            'settings.navbar_glass_blur' => 'required|string|max:50',
            'settings.navbar_border_color' => 'required|string|max:100',
            'settings.navbar_shadow_strength' => 'required|string|max:100',
            'settings.navbar_height' => 'required|string|max:50',
            'settings.navbar_font_weight' => 'required|string|max:50',

            // Footer
            'settings.footer_logo' => 'nullable|string|max:255',
            'settings.footer_company_name' => 'required|string|max:255',
            'settings.footer_description' => 'required|string',
            'settings.footer_quick_links' => 'required|array',
            'settings.footer_services' => 'required|array',
            'settings.footer_newsletter_title' => 'required|string|max:255',
            'settings.footer_newsletter_desc' => 'required|string',
            'settings.footer_newsletter_active' => 'required|string|in:true,false',
            'settings.footer_socials' => 'required|array',
            'settings.footer_address' => 'required|string',
            'settings.footer_phone' => 'required|string',
            'settings.footer_email' => 'required|email|max:255',
            'settings.footer_copyright' => 'required|string',
            'settings.footer_tagline' => 'required|string|max:255',
            'settings.footer_bg' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.footer_text' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.footer_heading_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.footer_link_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.footer_link_hover_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.footer_icon_bg' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.footer_icon_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.footer_border_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.footer_newsletter_bg' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.footer_newsletter_btn_bg' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.footer_newsletter_btn_text' => 'required|string|max:255',
            'settings.footer_copyright_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.footer_bottom_bg' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.footer_shadow_strength' => 'required|string|max:100',
            'settings.footer_top_padding' => 'required|string|max:50',
            'settings.footer_bottom_padding' => 'required|string|max:50',
            'settings.footer_font_weight' => 'required|string|max:50',
            'settings.footer_bg_style' => 'required|string|in:solid-white,solid-navy,white-navy-accents,white-orange-lines,navy-gradient,white-gradient',
            'settings.footer_paragraph_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_secondary_text_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_quick_links_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_quick_links_hover_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_services_links_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_services_hover_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_newsletter_heading_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_newsletter_description_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_bottom_tagline_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_icon_style' => 'required|string|in:circle,square,orange-gradient,navy-outline',
            'settings.footer_icon_hover_bg' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_icon_hover_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_icon_border_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_icon_shadow' => 'required|string|in:none,light,medium,strong',
            'settings.footer_newsletter_input_bg' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_newsletter_input_border' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_newsletter_input_text_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_newsletter_placeholder_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_newsletter_btn_hover_bg' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_newsletter_btn_hover_text_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_newsletter_btn_shadow' => 'required|string|in:none,light,medium,strong',
            'settings.footer_divider_style' => 'required|string|in:orange,navy,gradient,thin-accent,double',
            'settings.footer_social_icon_bg' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_social_icon_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_social_hover_bg' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_social_hover_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_social_border_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\)|transparent)$/'],
            'settings.footer_social_shadow' => 'required|string|in:none,light,medium,strong',
            'settings.footer_column_gap' => 'required|string|max:50',
            'settings.footer_section_gap' => 'required|string|max:50',
            'settings.footer_link_hover_effect' => 'required|string|in:underline,slide,arrow,color',
            'settings.footer_animation_style' => 'required|string|in:none,fade-in,slide-up,footer-reveal',

            // Global Spacing & Typography
            'settings.heading_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.paragraph_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.small_text_color' => ['required', 'string', 'regex:/^(#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})|rgba?\(.*\))$/'],
            'settings.container_width' => 'required|string|max:50',

            // Upload files
            'navbar_logo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'footer_logo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $settingsData = $validated['settings'];

        // Encode JSON fields back to strings
        $jsonKeys = ['navbar_links', 'footer_quick_links', 'footer_services', 'footer_socials'];
        foreach ($jsonKeys as $key) {
            if (isset($settingsData[$key])) {
                $settingsData[$key] = json_encode($settingsData[$key]);
            }
        }

        // Handle logo files
        if ($request->hasFile('navbar_logo_file')) {
            $file = $request->file('navbar_logo_file');
            $fileName = 'navbar_logo_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            if (!file_exists(public_path('images'))) {
                mkdir(public_path('images'), 0755, true);
            }
            $file->move(public_path('images'), $fileName);
            $settingsData['navbar_logo'] = '/images/' . $fileName;
        }

        if ($request->hasFile('footer_logo_file')) {
            $file = $request->file('footer_logo_file');
            $fileName = 'footer_logo_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            if (!file_exists(public_path('images'))) {
                mkdir(public_path('images'), 0755, true);
            }
            $file->move(public_path('images'), $fileName);
            $settingsData['footer_logo'] = '/images/' . $fileName;
        }

        $this->cmsService->updateSettings($settingsData);

        return back()->with('success', 'Global Layout configurations saved successfully.');
    }
}
