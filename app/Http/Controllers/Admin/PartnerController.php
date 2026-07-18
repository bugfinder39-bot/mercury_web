<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;

class PartnerController extends Controller
{
    /**
     * Display a listing of partners.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Partners/Index', [
            'partners' => Partner::orderBy('order')->get(),
        ]);
    }

    /**
     * Show the form for creating a new partner.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Partners/Create');
    }

    /**
     * Store a newly created partner in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'link' => 'nullable|url|max:255',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            if (!file_exists(public_path('images/partners'))) {
                mkdir(public_path('images/partners'), 0755, true);
            }
            $file->move(public_path('images/partners'), $fileName);
            $validated['logo'] = '/images/partners/' . $fileName;
        } else {
            $validated['logo'] = null;
        }

        Partner::create($validated);

        return redirect()->route('admin.partners.index')->with('success', 'Partner created successfully.');
    }

    /**
     * Show the form for editing the specified partner.
     */
    public function edit(Partner $partner): Response
    {
        return Inertia::render('Admin/Partners/Edit', [
            'partner' => $partner,
        ]);
    }

    /**
     * Update the specified partner in storage.
     */
    public function update(Request $request, Partner $partner): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable',
            'link' => 'nullable|url|max:255',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);

            // Delete old logo if it exists
            if ($partner->logo && file_exists(public_path($partner->logo))) {
                @unlink(public_path($partner->logo));
            }

            $file = $request->file('logo');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            if (!file_exists(public_path('images/partners'))) {
                mkdir(public_path('images/partners'), 0755, true);
            }
            $file->move(public_path('images/partners'), $fileName);
            $validated['logo'] = '/images/partners/' . $fileName;
        } else {
            // Keep existing logo
            $validated['logo'] = $partner->logo;
        }

        $partner->update($validated);

        return redirect()->route('admin.partners.index')->with('success', 'Partner updated successfully.');
    }

    /**
     * Remove the specified partner from storage.
     */
    public function destroy(Partner $partner): RedirectResponse
    {
        if ($partner->logo && file_exists(public_path($partner->logo))) {
            @unlink(public_path($partner->logo));
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Partner deleted successfully.');
    }
}

