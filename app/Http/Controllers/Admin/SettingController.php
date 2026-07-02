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
            'settings.*' => 'nullable|string',
        ]);

        $this->cmsService->updateSettings($validated['settings']);

        return back()->with('success', 'Global configurations saved.');
    }
}

