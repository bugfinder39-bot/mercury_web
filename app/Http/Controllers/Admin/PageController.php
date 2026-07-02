<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Section;
use App\Models\SectionItem;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class PageController extends Controller
{
    protected \App\Services\CmsService $cmsService;

    public function __construct(\App\Services\CmsService $cmsService)
    {
        $this->cmsService = $cmsService;
    }

    /**
     * Display a listing of editable pages.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Pages/Index', [
            'pages' => Page::orderBy('name')->get(),
        ]);
    }

    /**
     * Show the editor page for a specific page with all sections and items.
     */
    public function edit(Page $page): Response
    {
        $sections = $page->sections()
            ->with(['items' => function ($query) {
                $query->orderBy('order');
            }])
            ->orderBy('order')
            ->get();

        return Inertia::render('Admin/Pages/Edit', [
            'page' => $page,
            'sections' => $sections,
        ]);
    }

    /**
     * Update page level settings (like SEO metadata).
     */
    public function update(Request $request, Page $page): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'og_image' => 'nullable|string|max:255',
        ]);

        $page->update($validated);

        return back()->with('success', 'Page details updated successfully.');
    }

    /**
     * Update a specific section content.
     */
    public function updateSection(Request $request, Section $section): RedirectResponse
    {
        $validated = $request->validate([
            'heading' => 'nullable|string|max:255',
            'subheading' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'is_active' => 'required|boolean',
            'order' => 'required|integer',
        ]);

        $this->cmsService->updateSection($section, $validated);

        return back()->with('success', 'Section updated successfully.');
    }

    /**
     * Add a repeatable item to a section.
     */
    public function storeSectionItem(Request $request, Section $section): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'value' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $this->cmsService->storeSectionItem($section, $validated);

        return back()->with('success', 'Section item added successfully.');
    }

    /**
     * Update a specific section item.
     */
    public function updateSectionItem(Request $request, SectionItem $item): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'value' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $this->cmsService->updateSectionItem($item, $validated);


        return back()->with('success', 'Section item updated successfully.');
    }

    /**
     * Delete a specific section item.
     */
    public function destroySectionItem(SectionItem $item): RedirectResponse
    {
        $item->delete();

        return back()->with('success', 'Section item deleted successfully.');
    }
}
