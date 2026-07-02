<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

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
            'logo' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

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
            'logo' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $partner->update($validated);

        return redirect()->route('admin.partners.index')->with('success', 'Partner updated successfully.');
    }

    /**
     * Remove the specified partner from storage.
     */
    public function destroy(Partner $partner): RedirectResponse
    {
        $partner->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Partner deleted successfully.');
    }
}
