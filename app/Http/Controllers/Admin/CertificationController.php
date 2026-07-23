<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\Section;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;

class CertificationController extends Controller
{
    /**
     * Categories list for consistent usage
     */
    public static array $categories = [
        'Certification',
        'Membership',
        'License',
        'Award',
        'Accreditation',
        'Affiliation',
    ];

    /**
     * Display a listing of certifications.
     */
    public function index(Request $request): Response
    {
        $query = Certification::query();

        // Search query
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('short_name', 'like', "%{$search}%")
                  ->orWhere('issuing_organization', 'like', "%{$search}%")
                  ->orWhere('certificate_number', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        // Status filter
        if ($request->filled('status')) {
            $status = $request->input('status');
            if ($status === 'active') {
                $query->where('is_active', true);
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $certifications = $query->orderBy('order')->orderBy('id', 'desc')->get();

        $section = Section::where('type', 'certifications')->first();

        return Inertia::render('Admin/Certifications/Index', [
            'certifications' => $certifications,
            'categories' => self::$categories,
            'filters' => $request->only(['search', 'category', 'status']),
            'section' => $section,
        ]);
    }

    /**
     * Show the form for creating a new certification.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Certifications/Create', [
            'categories' => self::$categories,
            'maxOrder' => (Certification::max('order') ?? 0) + 1,
        ]);
    }

    /**
     * Store a newly created certification in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_name' => 'nullable|string|max:255',
            'category' => 'required|string|max:100',
            'issuing_organization' => 'required|string|max:255',
            'issue_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after_or_equal:issue_date',
            'certificate_number' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'detailed_description' => 'nullable|string',
            'official_website_url' => 'nullable|url|max:255',
            'logo' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'certificate_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            'certificate_pdf' => 'nullable|file|mimes:pdf|max:15360',
            'background_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
            'is_featured' => 'required|boolean',
        ]);

        $uploadDir = public_path('uploads/certifications');
        if (!File::exists($uploadDir)) {
            File::makeDirectory($uploadDir, 0755, true);
        }

        // Handle file uploads
        foreach (['logo', 'certificate_image', 'certificate_pdf', 'background_image'] as $fileKey) {
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                $filename = time() . '_' . $fileKey . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($uploadDir, $filename);
                $validated[$fileKey] = '/uploads/certifications/' . $filename;
            } else {
                $validated[$fileKey] = null;
            }
        }

        Certification::create($validated);

        return redirect()->route('admin.certifications.index')->with('success', 'Certification created successfully.');
    }

    /**
     * Show the form for editing the specified certification.
     */
    public function edit(Certification $certification): Response
    {
        return Inertia::render('Admin/Certifications/Edit', [
            'certification' => $certification,
            'categories' => self::$categories,
        ]);
    }

    /**
     * Update the specified certification in storage.
     */
    public function update(Request $request, Certification $certification): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_name' => 'nullable|string|max:255',
            'category' => 'required|string|max:100',
            'issuing_organization' => 'required|string|max:255',
            'issue_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after_or_equal:issue_date',
            'certificate_number' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'detailed_description' => 'nullable|string',
            'official_website_url' => 'nullable|url|max:255',
            'logo' => 'nullable',
            'certificate_image' => 'nullable',
            'certificate_pdf' => 'nullable',
            'background_image' => 'nullable',
            'delete_logo' => 'nullable|boolean',
            'delete_certificate_image' => 'nullable|boolean',
            'delete_certificate_pdf' => 'nullable|boolean',
            'delete_background_image' => 'nullable|boolean',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
            'is_featured' => 'required|boolean',
        ]);

        $uploadDir = public_path('uploads/certifications');
        if (!File::exists($uploadDir)) {
            File::makeDirectory($uploadDir, 0755, true);
        }

        foreach (['logo', 'certificate_image', 'certificate_pdf', 'background_image'] as $fileKey) {
            $deleteKey = 'delete_' . $fileKey;
            if ($request->boolean($deleteKey) && $certification->{$fileKey}) {
                if (File::exists(public_path($certification->{$fileKey}))) {
                    @File::delete(public_path($certification->{$fileKey}));
                }
                $validated[$fileKey] = null;
            } elseif ($request->hasFile($fileKey)) {
                $request->validate([
                    $fileKey => $fileKey === 'certificate_pdf'
                        ? 'file|mimes:pdf|max:15360'
                        : 'file|mimes:jpeg,png,jpg,gif,svg,webp|max:10240'
                ]);

                // Delete old file
                if ($certification->{$fileKey} && File::exists(public_path($certification->{$fileKey}))) {
                    @File::delete(public_path($certification->{$fileKey}));
                }

                $file = $request->file($fileKey);
                $filename = time() . '_' . $fileKey . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($uploadDir, $filename);
                $validated[$fileKey] = '/uploads/certifications/' . $filename;
            } else {
                $validated[$fileKey] = $certification->{$fileKey};
            }

            unset($validated[$deleteKey]);
        }

        $certification->update($validated);

        return redirect()->route('admin.certifications.index')->with('success', 'Certification updated successfully.');
    }

    /**
     * Remove the specified certification from storage.
     */
    public function destroy(Certification $certification): RedirectResponse
    {
        foreach (['logo', 'certificate_image', 'certificate_pdf', 'background_image'] as $fileKey) {
            if ($certification->{$fileKey} && File::exists(public_path($certification->{$fileKey}))) {
                @File::delete(public_path($certification->{$fileKey}));
            }
        }

        $certification->delete();

        return redirect()->route('admin.certifications.index')->with('success', 'Certification deleted successfully.');
    }

    /**
     * Toggle active status.
     */
    public function toggleStatus(Certification $certification): RedirectResponse
    {
        $certification->update([
            'is_active' => !$certification->is_active,
        ]);

        return redirect()->back()->with('success', 'Certification status updated.');
    }

    /**
     * Reorder certifications.
     */
    public function reorder(Request $request): RedirectResponse
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:certifications,id',
            'items.*.order' => 'required|integer',
        ]);

        foreach ($request->input('items') as $item) {
            Certification::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return redirect()->back()->with('success', 'Certifications reordered successfully.');
    }

    /**
     * Duplicate a certification.
     */
    public function duplicate(Certification $certification): RedirectResponse
    {
        $newCertification = $certification->replicate();
        $newCertification->title = $certification->title . ' (Copy)';
        $newCertification->order = (Certification::max('order') ?? 0) + 1;
        $newCertification->save();

        return redirect()->route('admin.certifications.index')->with('success', 'Certification duplicated successfully.');
    }

    /**
     * Update certifications section settings.
     */
    public function updateSectionSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'heading' => 'required|string|max:255',
            'subheading' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $section = Section::where('type', 'certifications')->first();
        if ($section) {
            $section->update($validated);
        }

        return redirect()->back()->with('success', 'Certifications section settings updated.');
    }
}
