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
                'heroMedia',
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
            'hero_media_id' => 'nullable|integer',
            // CEO message fields
            'ceo_rich_text' => 'nullable|string',
            'ceo_name' => 'nullable|string|max:255',
            'ceo_designation' => 'nullable|string|max:255',
            'signature_media_id' => 'nullable|integer',
            'portrait_media_id' => 'nullable|integer',
            'show_ceo_image' => 'nullable|boolean',
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
            // Contact Form fields
            'form_card_title' => 'nullable|string|max:255',
            'form_description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_icon' => 'nullable|string|max:255',
            'success_message' => 'nullable|string|max:255',
            'error_message' => 'nullable|string|max:255',
            'required_field_text' => 'nullable|string|max:255',
            'placeholder_text' => 'nullable|string|max:255',
            // Uploads
            'hero_media_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            'portrait_media_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            'signature_media_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            'cta_background_media_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
        ]);

        try {
            if ($request->hasFile('hero_media_file')) {
                if ($section->hero_media_id) {
                    $this->deleteMediaById($section->hero_media_id);
                }
                $file = $request->file('hero_media_file');
                $size = $file->getSize();
                $mime = $file->getClientMimeType();
                $extension = $file->getClientOriginalExtension() ?: 'jpg';
                $fileName = 'hero_' . time() . '_' . uniqid() . '.' . $extension;
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
                $validated['hero_media_id'] = $media->id;
            } elseif ($request->boolean('delete_hero_media')) {
                if ($section->hero_media_id) {
                    $this->deleteMediaById($section->hero_media_id);
                }
                $validated['hero_media_id'] = null;
            }

            if ($request->hasFile('portrait_media_file')) {
                if ($section->portrait_media_id) {
                    $this->deleteMediaById($section->portrait_media_id);
                }
                $file = $request->file('portrait_media_file');
                $size = $file->getSize();
                $mime = $file->getClientMimeType();
                $extension = $file->getClientOriginalExtension() ?: 'jpg';
                $fileName = 'portrait_' . time() . '_' . uniqid() . '.' . $extension;
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
            } elseif ($request->boolean('delete_portrait_media')) {
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
                $extension = $file->getClientOriginalExtension() ?: 'jpg';
                $fileName = 'signature_' . time() . '_' . uniqid() . '.' . $extension;
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
            } elseif ($request->boolean('delete_signature_media')) {
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
                $extension = $file->getClientOriginalExtension() ?: 'jpg';
                $fileName = 'cta_bg_' . time() . '_' . uniqid() . '.' . $extension;
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
            } elseif ($request->boolean('delete_cta_background_media')) {
                if ($section->cta_background_media_id) {
                    $this->deleteMediaById($section->cta_background_media_id);
                }
                $validated['cta_background_media_id'] = null;
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Section media upload failed: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            throw $e;
        }

        unset(
            $validated['hero_media_file'],
            $validated['portrait_media_file'],
            $validated['signature_media_file'],
            $validated['cta_background_media_file'],
            $validated['delete_hero_media'],
            $validated['delete_portrait_media'],
            $validated['delete_signature_media'],
            $validated['delete_cta_background_media']
        );

        $this->cmsService->updateSection($section, $validated);

        return back()->with('success', 'Section updated successfully.');
    }

    /**
     * Add a repeatable item to a section.
     */
    public function storeSectionItem(Request $request, Section $section): RedirectResponse
    {
        $rules = [
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'value' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
            'address' => 'nullable|string',
            'map_url' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'office_hours' => 'nullable|string|max:255',
            'emergency_contact' => 'nullable|string|max:255',
            'latitude' => 'nullable|string|max:255',
            'longitude' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'office_location' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'extension' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|string|url|max:255',
            'facebook_url' => 'nullable|string|url|max:255',
            'field_name' => 'nullable|string|max:255',
            'field_type' => 'nullable|string|max:255',
            'placeholder' => 'nullable|string|max:255',
            'is_required' => 'nullable|boolean',
            'width' => 'nullable|string|max:255',
            'help_text' => 'nullable|string',
            'default_value' => 'nullable|string|max:255',
            'options' => 'nullable|string',
        ];

        if ($section->type !== 'office_team') {
            $rules['image_media_file'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240';
        }

        $validated = $request->validate($rules);

        if ($section->type !== 'office_team' && $request->hasFile('image_media_file')) {
            $file = $request->file('image_media_file');
            $size = $file->getSize();
            $mime = $file->getClientMimeType();
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $fileName = 'item_' . time() . '_' . uniqid() . '.' . $extension;
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

        unset($validated['image_media_file']);

        $this->cmsService->storeSectionItem($section, $validated);

        return back()->with('success', 'Section item added successfully.');
    }

    /**
     * Update a specific section item.
     */
    public function updateSectionItem(Request $request, SectionItem $item): RedirectResponse
    {
        $rules = [
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'value' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
            'address' => 'nullable|string',
            'map_url' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'office_hours' => 'nullable|string|max:255',
            'emergency_contact' => 'nullable|string|max:255',
            'latitude' => 'nullable|string|max:255',
            'longitude' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'office_location' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'extension' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|string|url|max:255',
            'facebook_url' => 'nullable|string|url|max:255',
            'field_name' => 'nullable|string|max:255',
            'field_type' => 'nullable|string|max:255',
            'placeholder' => 'nullable|string|max:255',
            'is_required' => 'nullable|boolean',
            'width' => 'nullable|string|max:255',
            'help_text' => 'nullable|string',
            'default_value' => 'nullable|string|max:255',
            'options' => 'nullable|string',
        ];

        $isOfficeTeam = $item->section && $item->section->type === 'office_team';

        if (!$isOfficeTeam) {
            $rules['image_media_file'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240';
            $rules['delete_image_media'] = 'nullable|boolean';
        }

        $validated = $request->validate($rules);

        if (!$isOfficeTeam) {
            if ($request->hasFile('image_media_file')) {
                if ($item->image_media_id) {
                    $this->deleteMediaById($item->image_media_id);
                }
                $file = $request->file('image_media_file');
                $size = $file->getSize();
                $mime = $file->getClientMimeType();
                $extension = $file->getClientOriginalExtension() ?: 'jpg';
                $fileName = 'item_' . time() . '_' . uniqid() . '.' . $extension;
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
            } elseif ($request->boolean('delete_image_media')) {
                if ($item->image_media_id) {
                    $this->deleteMediaById($item->image_media_id);
                }
                $validated['image_media_id'] = null;
            }
        }

        unset($validated['image_media_file'], $validated['delete_image_media']);

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
            $relativePath = ltrim($media->file_path, '/\\');
            $filePath = public_path($relativePath);
            if (file_exists($filePath) && is_file($filePath)) {
                @unlink($filePath);
            }
            $media->delete();
        }
    }
}
