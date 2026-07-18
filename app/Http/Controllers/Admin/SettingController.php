<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class SettingController extends Controller
{
    protected \App\Services\CmsService $cmsService;

    public function __construct(\App\Services\CmsService $cmsService)
    {
        $this->cmsService = $cmsService;
    }

    /**
     * Display general and seo settings for editing.
     */
    public function edit(): Response
    {
        $settings = $this->cmsService->getAllSettings();

        return Inertia::render('Admin/Settings/Edit', [
            'settings' => $settings,
        ]);
    }

    /**
     * Update configuration parameters.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'settings.company_name' => 'nullable|string|max:255',
            'settings.company_tagline' => 'nullable|string|max:255',
            'settings.company_logo' => 'nullable|string|max:255',
            'settings.company_favicon' => 'nullable|string|max:255',
            'settings.contact_email' => 'nullable|email|max:255',
            'settings.contact_phone' => 'nullable|string|max:255',
            'settings.contact_address' => 'nullable|string',
            'settings.office_hours' => 'nullable|string|max:255',
            'settings.social_linkedin' => 'nullable|url|max:255',
            'settings.social_facebook' => 'nullable|url|max:255',
            'settings.google_maps_embed' => 'nullable|string',
            'settings.default_seo_title' => 'nullable|string|max:255',
            'settings.default_seo_description' => 'nullable|string',
            'company_logo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'company_favicon_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,ico|max:1024',
        ]);

        $settingsData = $validated['settings'];

        if ($request->hasFile('company_logo_file')) {
            $file = $request->file('company_logo_file');
            $fileName = 'logo_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            if (!file_exists(public_path('images'))) {
                mkdir(public_path('images'), 0755, true);
            }
            $file->move(public_path('images'), $fileName);
            $settingsData['company_logo'] = '/images/' . $fileName;
        }

        if ($request->hasFile('company_favicon_file')) {
            $file = $request->file('company_favicon_file');
            $fileName = 'favicon_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            if (!file_exists(public_path('images'))) {
                mkdir(public_path('images'), 0755, true);
            }
            $file->move(public_path('images'), $fileName);
            $settingsData['company_favicon'] = '/images/' . $fileName;
        }

        $this->cmsService->updateSettings($settingsData);

        return back()->with('success', 'Global configurations saved.');
    }
}

