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
            ->with([
                'items' => function ($query) {
                    $query->orderBy('order');
                },
                'items.imageMedia',
                'portraitMedia',
                'signatureMedia',
                'ctaBackgroundMedia'
            ])
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
            // CEO message fields
            'ceo_rich_text' => 'nullable|string',
            'ceo_name' => 'nullable|string|max:255',
            'ceo_designation' => 'nullable|string|max:255',
            'signature_media_id' => 'nullable|integer',
            'portrait_media_id' => 'nullable|integer',
            'ceo_cta_button_text' => 'nullable|string|max:255',
            'ceo_cta_button_url' => 'nullable|string|max:255',
            // CTA banner fields
            'cta_banner_heading' => 'nullable|string|max:255',
            'cta_banner_subheading' => 'nullable|string|max:255',
            'cta_background_media_id' => 'nullable|integer',
            'cta_primary_btn_text' => 'nullable|string|max:255',
            'cta_primary_btn_url' => 'nullable|string|max:255',
            'cta_secondary_btn_text' => 'nullable|string|max:255',
            'cta_secondary_btn_url' => 'nullable|string|max:255',
            // Uploads
            'portrait_media_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'signature_media_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'cta_background_media_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('portrait_media_file')) {
            if ($section->portrait_media_id) {
                $this->deleteMediaById($section->portrait_media_id);
            }
            $file = $request->file('portrait_media_file');
            $size = $file->getSize();
            $mime = $file->getClientMimeType();
            $fileName = 'portrait_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            if (!file_exists(public_path('uploads/media'))) {
                mkdir(public_path('uploads/media'), 0755, true);
            }
            $file->move(public_path('uploads/media'), $fileName);
            $media = \App\Models\Media::create([
                'file_path' => '/uploads/media/' . $fileName,
                'filename' => $fileName,
                'mime_type' => $mime,
                'size' => $size,
            ]);
            $validated['portrait_media_id'] = $media->id;
        } elseif ($request->input('delete_portrait_media')) {
            if ($section->portrait_media_id) {
                $this->deleteMediaById($section->portrait_media_id);
            }
            $validated['portrait_media_id'] = null;
        }

        if ($request->hasFile('signature_media_file')) {
            if ($section->signature_media_id) {
                $this->deleteMediaById($section->signature_media_id);
            }
            $file = $request->file('signature_media_file');
            $size = $file->getSize();
            $mime = $file->getClientMimeType();
            $fileName = 'signature_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            if (!file_exists(public_path('uploads/media'))) {
                mkdir(public_path('uploads/media'), 0755, true);
            }
            $file->move(public_path('uploads/media'), $fileName);
            $media = \App\Models\Media::create([
                'file_path' => '/uploads/media/' . $fileName,
                'filename' => $fileName,
                'mime_type' => $mime,
                'size' => $size,
            ]);
            $validated['signature_media_id'] = $media->id;
        } elseif ($request->input('delete_signature_media')) {
            if ($section->signature_media_id) {
                $this->deleteMediaById($section->signature_media_id);
            }
            $validated['signature_media_id'] = null;
        }

        if ($request->hasFile('cta_background_media_file')) {
            if ($section->cta_background_media_id) {
                $this->deleteMediaById($section->cta_background_media_id);
            }
            $file = $request->file('cta_background_media_file');
            $size = $file->getSize();
            $mime = $file->getClientMimeType();
            $fileName = 'cta_bg_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            if (!file_exists(public_path('uploads/media'))) {
                mkdir(public_path('uploads/media'), 0755, true);
            }
            $file->move(public_path('uploads/media'), $fileName);
            $media = \App\Models\Media::create([
                'file_path' => '/uploads/media/' . $fileName,
                'filename' => $fileName,
                'mime_type' => $mime,
                'size' => $size,
            ]);
            $validated['cta_background_media_id'] = $media->id;
        } elseif ($request->input('delete_cta_background_media')) {
            if ($section->cta_background_media_id) {
                $this->deleteMediaById($section->cta_background_media_id);
            }
            $validated['cta_background_media_id'] = null;
        }

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
            'image_media_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'address' => 'nullable|string',
            'map_url' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'office_hours' => 'nullable|string|max:255',
            'emergency_contact' => 'nullable|string|max:255',
            'latitude' => 'nullable|string|max:255',
            'longitude' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image_media_file')) {
            $file = $request->file('image_media_file');
            $size = $file->getSize();
            $mime = $file->getClientMimeType();
            $fileName = 'item_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            if (!file_exists(public_path('uploads/media'))) {
                mkdir(public_path('uploads/media'), 0755, true);
            }
            $file->move(public_path('uploads/media'), $fileName);
            $media = \App\Models\Media::create([
                'file_path' => '/uploads/media/' . $fileName,
                'filename' => $fileName,
                'mime_type' => $mime,
                'size' => $size,
            ]);
            $validated['image_media_id'] = $media->id;
        }

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
            'image_media_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'delete_image_media' => 'nullable|boolean',
            'address' => 'nullable|string',
            'map_url' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'office_hours' => 'nullable|string|max:255',
            'emergency_contact' => 'nullable|string|max:255',
            'latitude' => 'nullable|string|max:255',
            'longitude' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image_media_file')) {
            if ($item->image_media_id) {
                $this->deleteMediaById($item->image_media_id);
            }
            $file = $request->file('image_media_file');
            $size = $file->getSize();
            $mime = $file->getClientMimeType();
            $fileName = 'item_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            if (!file_exists(public_path('uploads/media'))) {
                mkdir(public_path('uploads/media'), 0755, true);
            }
            $file->move(public_path('uploads/media'), $fileName);
            $media = \App\Models\Media::create([
                'file_path' => '/uploads/media/' . $fileName,
                'filename' => $fileName,
                'mime_type' => $mime,
                'size' => $size,
            ]);
            $validated['image_media_id'] = $media->id;
        } elseif ($request->input('delete_image_media')) {
            if ($item->image_media_id) {
                $this->deleteMediaById($item->image_media_id);
            }
            $validated['image_media_id'] = null;
        }

        $this->cmsService->updateSectionItem($item, $validated);

        return back()->with('success', 'Section item updated successfully.');
    }

    /**
     * Delete a specific section item.
     */
    public function destroySectionItem(SectionItem $item): RedirectResponse
    {
        if ($item->image_media_id) {
            $this->deleteMediaById($item->image_media_id);
        }
        $item->delete();

        return back()->with('success', 'Section item deleted successfully.');
    }

    /**
     * Delete media record and physical file by ID.
     */
    protected function deleteMediaById(?int $mediaId): void
    {
        if (!$mediaId) {
            return;
        }

        $media = \App\Models\Media::find($mediaId);
        if ($media) {
            $filePath = public_path($media->file_path);
            if (file_exists($filePath) && is_file($filePath)) {
                @unlink($filePath);
            }
            $media->delete();
        }
    }
}
