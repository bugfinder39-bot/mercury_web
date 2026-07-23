<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of admin users.
     */
    public function index(Request $request): Response
    {
        $currentUser = $request->user();
        if (! $currentUser->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $query = User::query();

        // Search filter
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%");
            });
        }

        // Role filter
        if ($role = $request->input('role')) {
            if (in_array($role, ['super_admin', 'content_editor'])) {
                $query->where('role', $role);
            }
        }

        // Status filter
        if ($status = $request->input('status')) {
            if (in_array($status, ['active', 'inactive'])) {
                $query->where('status', $status);
            }
        }

        // Sorting
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = strtolower($request->input('sort_order', 'desc')) === 'asc' ? 'asc' : 'desc';
        $allowedSorts = ['name', 'email', 'role', 'status', 'last_login_at', 'created_at'];

        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $users = $query->paginate(10)->withQueryString();

        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
            'filters' => [
                'search' => $request->input('search', ''),
                'role' => $request->input('role', ''),
                'status' => $request->input('status', ''),
                'sort_by' => $sortBy,
                'sort_order' => $sortOrder,
            ],
            'can' => [
                'create_user' => true,
                'create_super_admin' => $currentUser->isSuperAdmin(),
                'delete_user' => $currentUser->isSuperAdmin(),
            ],
        ]);
    }

    /**
     * Show the form for creating a new admin user.
     */
    public function create(Request $request): Response
    {
        $currentUser = $request->user();
        if (! $currentUser->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        return Inertia::render('Admin/Users/Create', [
            'canCreateSuperAdmin' => $currentUser->isSuperAdmin(),
        ]);
    }

    /**
     * Store a newly created admin user.
     */
    public function store(Request $request): RedirectResponse
    {
        $currentUser = $request->user();
        if (! $currentUser->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => 'required|string|in:super_admin,content_editor',
            'status' => 'required|string|in:active,inactive',
            'avatar_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Content Editors cannot create Super Admins
        if (! $currentUser->isSuperAdmin() && $validated['role'] === 'super_admin') {
            return back()->withErrors(['role' => 'Content Editors cannot create Super Admin accounts.']);
        }

        $avatarPath = null;
        if ($request->hasFile('avatar_file')) {
            $file = $request->file('avatar_file');
            $fileName = 'avatar_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            if (!file_exists(public_path('uploads/avatars'))) {
                mkdir(public_path('uploads/avatars'), 0755, true);
            }
            $file->move(public_path('uploads/avatars'), $fileName);
            $avatarPath = '/uploads/avatars/' . $fileName;
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'status' => $validated['status'],
            'avatar' => $avatarPath,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified admin user.
     */
    public function edit(Request $request, User $user): Response
    {
        $currentUser = $request->user();
        if (! $currentUser->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        return Inertia::render('Admin/Users/Edit', [
            'adminUser' => $user,
            'canCreateSuperAdmin' => $currentUser->isSuperAdmin(),
        ]);
    }

    /**
     * Update the specified admin user.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $currentUser = $request->user();
        if (! $currentUser->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'role' => 'required|string|in:super_admin,content_editor',
            'status' => 'required|string|in:active,inactive',
            'avatar_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'remove_avatar' => 'nullable|boolean',
        ]);

        // Content Editors cannot assign Super Admin role
        if (! $currentUser->isSuperAdmin() && $validated['role'] === 'super_admin') {
            return back()->withErrors(['role' => 'Content Editors cannot grant Super Admin role.']);
        }

        // Prevent deactivating own account
        if ($currentUser->id === $user->id && $validated['status'] === 'inactive') {
            return back()->withErrors(['status' => 'You cannot deactivate your own account.']);
        }

        // Prevent deactivating the last active Super Admin
        if ($user->isSuperAdmin() && $validated['status'] === 'inactive') {
            $activeSuperAdmins = User::where('role', 'super_admin')->where('status', 'active')->where('id', '!=', $user->id)->count();
            if ($activeSuperAdmins === 0) {
                return back()->withErrors(['status' => 'Cannot deactivate the last active Super Admin account.']);
            }
        }

        // Handle Avatar
        $avatarPath = $user->avatar;
        if (!empty($validated['remove_avatar']) && $validated['remove_avatar']) {
            if ($avatarPath && file_exists(public_path($avatarPath))) {
                @unlink(public_path($avatarPath));
            }
            $avatarPath = null;
        }

        if ($request->hasFile('avatar_file')) {
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                @unlink(public_path($user->avatar));
            }
            $file = $request->file('avatar_file');
            $fileName = 'avatar_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            if (!file_exists(public_path('uploads/avatars'))) {
                mkdir(public_path('uploads/avatars'), 0755, true);
            }
            $file->move(public_path('uploads/avatars'), $fileName);
            $avatarPath = '/uploads/avatars/' . $fileName;
        }

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'status' => $validated['status'],
            'avatar' => $avatarPath,
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()->route('admin.users.index')->with('success', 'User details updated successfully.');
    }

    /**
     * Toggle active/inactive status.
     */
    public function toggleStatus(Request $request, User $user): RedirectResponse
    {
        $currentUser = $request->user();
        if (! $currentUser->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        if ($currentUser->id === $user->id) {
            return back()->with('error', 'You cannot change your own account status.');
        }

        $newStatus = $user->status === 'active' ? 'inactive' : 'active';

        if ($newStatus === 'inactive' && $user->isSuperAdmin()) {
            $activeSuperAdmins = User::where('role', 'super_admin')->where('status', 'active')->where('id', '!=', $user->id)->count();
            if ($activeSuperAdmins === 0) {
                return back()->with('error', 'Cannot deactivate the last active Super Admin account.');
            }
        }

        $user->update(['status' => $newStatus]);

        return back()->with('success', "User account status updated to {$newStatus}.");
    }

    /**
     * Reset password directly.
     */
    public function resetPassword(Request $request, User $user): RedirectResponse
    {
        $currentUser = $request->user();
        if (! $currentUser->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', "Password for {$user->name} reset successfully.");
    }

    /**
     * Remove the specified admin user.
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        $currentUser = $request->user();

        if (! $currentUser->isSuperAdmin()) {
            return back()->with('error', 'Content Editors are not allowed to delete user accounts.');
        }

        if ($currentUser->id === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        if ($user->isSuperAdmin()) {
            $superAdminCount = User::where('role', 'super_admin')->count();
            if ($superAdminCount <= 1) {
                return back()->with('error', 'Cannot delete the last Super Admin account.');
            }
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User account deleted successfully.');
    }
}
