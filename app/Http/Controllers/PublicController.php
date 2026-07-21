<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Partner;
use App\Services\CmsService;
use Inertia\Inertia;
use Inertia\Response;

class PublicController extends Controller
{
    protected CmsService $cmsService;

    public function __construct(CmsService $cmsService)
    {
        $this->cmsService = $cmsService;
    }

    /**
     * Render the Home Page.
     */
    public function home(): Response
    {
        $page = $this->cmsService->getPageWithSections('home');
        $services = Service::where('is_active', true)->orderBy('order')->get();
        $partners = Partner::where('is_active', true)->orderBy('order')->get();

        return Inertia::render('Home', [
            'page' => $page,
            'sections' => $page->sections,
            'services' => $services,
            'partners' => $partners,
        ]);
    }

    /**
     * Render the About Page.
     */
    public function about(): Response
    {
        $page = $this->cmsService->getPageWithSections('about');
        $statsSection = \App\Models\Section::where('type', 'stats')
            ->with(['items' => function ($query) {
                $query->where('is_active', true)->orderBy('order');
            }])
            ->first();

        return Inertia::render('About', [
            'page' => $page,
            'sections' => $page->sections,
            'statsSection' => $statsSection,
        ]);
    }

    /**
     * Render the Services Page.
     */
    public function services(): Response
    {
        $page = $this->cmsService->getPageWithSections('services');
        $services = Service::where('is_active', true)->orderBy('order')->get();

        return Inertia::render('Services', [
            'page' => $page,
            'sections' => $page->sections,
            'services' => $services,
        ]);
    }

    /**
     * Render the Contact Page.
     */
    public function contact(): Response
    {
        $page = $this->cmsService->getPageWithSections('contact');

        return Inertia::render('Contact', [
            'page' => $page,
            'sections' => $page->sections,
        ]);
    }

    /**
     * Process contact form submission.
     */
    public function submitContactForm(\Illuminate\Http\Request $request): \Illuminate\Http\RedirectResponse
    {
        $contactSection = \App\Models\Section::where('type', 'contact_form')
            ->with(['items' => function ($query) {
                $query->where('is_active', true)->orderBy('order');
            }])
            ->first();

        $rules = [];
        $activeFields = $contactSection ? $contactSection->items : collect();

        if ($activeFields->count() > 0) {
            foreach ($activeFields as $field) {
                $fieldName = $field->field_name ?: \Illuminate\Support\Str::slug($field->title, '_');
                if (!$fieldName) {
                    continue;
                }

                $fieldRules = [];
                if ($field->is_required) {
                    $fieldRules[] = 'required';
                } else {
                    $fieldRules[] = 'nullable';
                }

                if ($field->field_type === 'email') {
                    $fieldRules[] = 'email';
                } elseif ($field->field_type === 'number') {
                    $fieldRules[] = 'numeric';
                } elseif ($field->field_type === 'file') {
                    $fieldRules[] = 'file|max:5120';
                } else {
                    $fieldRules[] = 'string';
                }

                $rules[$fieldName] = implode('|', $fieldRules);
            }
        } else {
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:50',
                'subject' => 'nullable|string|max:255',
                'message' => 'required|string',
            ];
        }

        $validated = $request->validate($rules);

        // Core fields mapping
        $coreData = [
            'name' => $validated['name'] ?? ($request->input('name') ?: 'N/A'),
            'email' => $validated['email'] ?? ($request->input('email') ?: 'N/A'),
            'phone' => $validated['phone'] ?? $request->input('phone'),
            'subject' => $validated['subject'] ?? $request->input('subject'),
            'message' => $validated['message'] ?? ($request->input('message') ?: 'N/A'),
        ];

        // Handle uploaded file if present in dynamic field
        $extraData = [];
        foreach ($request->all() as $key => $val) {
            if (in_array($key, ['_token', 'name', 'email', 'phone', 'subject', 'message'])) {
                continue;
            }
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $fileName = 'form_file_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                if (!file_exists(public_path('uploads/contact_files'))) {
                    mkdir(public_path('uploads/contact_files'), 0755, true);
                }
                $file->move(public_path('uploads/contact_files'), $fileName);
                $extraData[$key] = '/uploads/contact_files/' . $fileName;
            } else {
                $extraData[$key] = $val;
            }
        }

        if (!empty($extraData)) {
            $coreData['data'] = $extraData;
        }

        \App\Models\ContactMessage::create($coreData);

        $successMsg = $contactSection->success_message ?? 'Thank you! Your message has been received.';

        return back()->with('success', $successMsg);
    }
}


