<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NetworkLocation;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class NetworkLocationController extends Controller
{
    /**
     * Display a listing of network locations.
     */
    public function index(Request $request): Response
    {
        $query = NetworkLocation::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%");
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->filled('status')) {
            if ($request->input('status') === 'active') {
                $query->where('is_active', true);
            } elseif ($request->input('status') === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $locations = $query->orderBy('order')->orderBy('created_at', 'desc')->get();

        return Inertia::render('Admin/GlobalNetwork/Index', [
            'locations' => $locations,
            'filters' => $request->only(['search', 'type', 'status']),
            'locationTypes' => [
                'Corporate Office',
                'Branch Office',
                'Warehouse',
                'Sea Port',
                'Air Port',
                'Partner Office',
                'Agent',
                'Distribution Center',
            ],
        ]);
    }

    /**
     * Show the form for creating a new location.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/GlobalNetwork/Create', [
            'locationTypes' => [
                'Corporate Office',
                'Branch Office',
                'Warehouse',
                'Sea Port',
                'Air Port',
                'Partner Office',
                'Agent',
                'Distribution Center',
            ],
            'nextOrder' => NetworkLocation::max('order') + 1,
        ]);
    }

    /**
     * Store a newly created location in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'region' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'address' => 'required|string',
            'google_maps_url' => 'nullable|url|max:500',
            'phone' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:500',
            'description' => 'nullable|string',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
            'is_featured' => 'required|boolean',
            'marker_color' => 'nullable|string|max:50',
            'marker_icon' => 'nullable|string|max:50',
        ]);

        if (empty($validated['google_maps_url'])) {
            $validated['google_maps_url'] = "https://maps.google.com/?q={$validated['latitude']},{$validated['longitude']}";
        }

        NetworkLocation::create($validated);

        return redirect()->route('admin.global-network.index')->with('success', 'Location created successfully.');
    }

    /**
     * Show the form for editing the specified location.
     */
    public function edit(NetworkLocation $global_network): Response
    {
        return Inertia::render('Admin/GlobalNetwork/Edit', [
            'location' => $global_network,
            'locationTypes' => [
                'Corporate Office',
                'Branch Office',
                'Warehouse',
                'Sea Port',
                'Air Port',
                'Partner Office',
                'Agent',
                'Distribution Center',
            ],
        ]);
    }

    /**
     * Update the specified location in storage.
     */
    public function update(Request $request, NetworkLocation $global_network): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'region' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'address' => 'required|string',
            'google_maps_url' => 'nullable|url|max:500',
            'phone' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:500',
            'description' => 'nullable|string',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
            'is_featured' => 'required|boolean',
            'marker_color' => 'nullable|string|max:50',
            'marker_icon' => 'nullable|string|max:50',
        ]);

        if (empty($validated['google_maps_url'])) {
            $validated['google_maps_url'] = "https://maps.google.com/?q={$validated['latitude']},{$validated['longitude']}";
        }

        $global_network->update($validated);

        return redirect()->route('admin.global-network.index')->with('success', 'Location updated successfully.');
    }

    /**
     * Toggle the status of a location.
     */
    public function toggleStatus(NetworkLocation $global_network): RedirectResponse
    {
        $global_network->update([
            'is_active' => !$global_network->is_active,
        ]);

        return back()->with('success', 'Location status updated.');
    }

    /**
     * Update locations order.
     */
    public function reorder(Request $request): RedirectResponse
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:network_locations,id',
            'items.*.order' => 'required|integer',
        ]);

        foreach ($request->items as $item) {
            NetworkLocation::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return back()->with('success', 'Locations reordered successfully.');
    }

    /**
     * Remove the specified location from storage.
     */
    public function destroy(NetworkLocation $global_network): RedirectResponse
    {
        $global_network->delete();

        return redirect()->route('admin.global-network.index')->with('success', 'Location deleted successfully.');
    }
}
