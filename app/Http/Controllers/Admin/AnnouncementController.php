<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class AnnouncementController extends Controller
{
    public static array $types = [
        'General',
        'Holiday Notice',
        'Maintenance',
        'Shipping Delay',
        'Service Update',
        'Emergency Notice',
        'Success Message',
        'Information',
    ];

    public static array $priorities = [
        'Low',
        'Normal',
        'High',
        'Critical',
    ];

    public static array $locations = [
        'top_bar' => 'Top Bar (above Navbar)',
        'banner' => 'Banner (Top of Page)',
        'popup' => 'Popup Modal',
        'inline' => 'Inline Section',
    ];

    /**
     * Display a listing of announcements.
     */
    public function index(Request $request): Response
    {
        $query = Announcement::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('full_description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->input('priority'));
        }

        if ($request->filled('location')) {
            $query->where('display_location', $request->input('location'));
        }

        if ($request->filled('status')) {
            $status = $request->input('status');
            if ($status === 'active') {
                $query->where('is_active', true);
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $announcements = $query->orderBy('is_pinned', 'desc')
            ->orderBy('display_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $settings = Setting::where('group', 'announcement')
            ->orWhere('key', 'like', 'announcement_%')
            ->pluck('value', 'key')
            ->toArray();

        return Inertia::render('Admin/Announcements/Index', [
            'announcements' => $announcements,
            'types' => self::$types,
            'priorities' => self::$priorities,
            'locations' => self::$locations,
            'filters' => $request->only(['search', 'type', 'priority', 'location', 'status']),
            'sectionSettings' => $settings,
        ]);
    }

    /**
     * Show the form for creating a new announcement.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Announcements/Create', [
            'types' => self::$types,
            'priorities' => self::$priorities,
            'locations' => self::$locations,
            'maxOrder' => (Announcement::max('display_order') ?? 0) + 1,
        ]);
    }

    /**
     * Store a newly created announcement in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'full_description' => 'nullable|string',
            'type' => 'required|string|max:100',
            'priority' => 'required|string|max:100',
            'bg_color' => 'nullable|string|max:50',
            'text_color' => 'nullable|string|max:50',
            'icon' => 'nullable|string|max:100',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'display_order' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
            'is_pinned' => 'required|boolean',
            'is_dismissible' => 'required|boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'display_location' => 'required|string|max:50',
            'target_pages' => 'required|string|max:50',
            'specific_pages' => 'nullable|array',
            'specific_pages.*' => 'string|max:255',
        ]);

        Announcement::create($validated);

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement created successfully!');
    }

    /**
     * Show the form for editing an existing announcement.
     */
    public function edit(Announcement $announcement): Response
    {
        return Inertia::render('Admin/Announcements/Edit', [
            'announcement' => $announcement,
            'types' => self::$types,
            'priorities' => self::$priorities,
            'locations' => self::$locations,
        ]);
    }

    /**
     * Update an announcement in storage.
     */
    public function update(Request $request, Announcement $announcement): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'full_description' => 'nullable|string',
            'type' => 'required|string|max:100',
            'priority' => 'required|string|max:100',
            'bg_color' => 'nullable|string|max:50',
            'text_color' => 'nullable|string|max:50',
            'icon' => 'nullable|string|max:100',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'display_order' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
            'is_pinned' => 'required|boolean',
            'is_dismissible' => 'required|boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'display_location' => 'required|string|max:50',
            'target_pages' => 'required|string|max:50',
            'specific_pages' => 'nullable|array',
            'specific_pages.*' => 'string|max:255',
        ]);

        $announcement->update($validated);

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement updated successfully!');
    }

    /**
     * Delete an announcement.
     */
    public function destroy(Announcement $announcement): RedirectResponse
    {
        $announcement->delete();

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement deleted successfully!');
    }

    /**
     * Toggle status (active/inactive).
     */
    public function toggleStatus(Announcement $announcement): RedirectResponse
    {
        $announcement->update([
            'is_active' => !$announcement->is_active,
        ]);

        $statusStr = $announcement->is_active ? 'enabled' : 'disabled';
        return redirect()->back()
            ->with('success', "Announcement '{$announcement->title}' {$statusStr} successfully!");
    }

    /**
     * Toggle pinned status.
     */
    public function togglePin(Announcement $announcement): RedirectResponse
    {
        $announcement->update([
            'is_pinned' => !$announcement->is_pinned,
        ]);

        $pinStr = $announcement->is_pinned ? 'pinned' : 'unpinned';
        return redirect()->back()
            ->with('success', "Announcement '{$announcement->title}' {$pinStr} successfully!");
    }

    /**
     * Reorder announcements.
     */
    public function reorder(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:announcements,id',
            'orders.*.display_order' => 'required|integer|min:0',
        ]);

        foreach ($validated['orders'] as $item) {
            Announcement::where('id', $item['id'])->update([
                'display_order' => $item['display_order'],
            ]);
        }

        return redirect()->back()->with('success', 'Announcement display order updated successfully!');
    }

    /**
     * Update section / system settings.
     */
    public function updateSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'announcement_system_enabled' => 'required|string',
            'announcement_show_multiple' => 'required|string',
            'announcement_max_items' => 'required|numeric|min:1|max:20',
            'announcement_auto_rotate' => 'required|string',
            'announcement_animation_style' => 'required|string|in:slide,fade,bounce',
            'announcement_display_duration' => 'required|numeric|min:2|max:30',
            'announcement_sticky' => 'required|string',
        ]);

        foreach ($validated as $key => $value) {
            Setting::updateOrInsert(
                ['key' => $key],
                ['value' => (string)$value, 'group' => 'announcement', 'updated_at' => now()]
            );
        }

        return redirect()->back()->with('success', 'Announcement system settings updated successfully!');
    }
}
