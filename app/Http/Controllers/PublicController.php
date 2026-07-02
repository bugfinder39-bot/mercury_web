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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        \App\Models\ContactMessage::create($validated);

        return back()->with('success', 'Thank you! Your message has been received.');
    }
}


