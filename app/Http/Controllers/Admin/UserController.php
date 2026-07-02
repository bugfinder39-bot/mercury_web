<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        // Enforce Super Admin check
        if (! $request->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action. Only Super Admins can manage users.');
        }

        return Inertia::render('Admin/Users/Index', [
            'users' => User::orderBy('name')->get(),
        ]);
    }

    /**
     * Show the form for creating a new admin user.
     */
    public function create(Request $request): Response
    {
        if (! $request->user()->isSuperAdmin()) {
            abort(403);
        }

        return Inertia::render('Admin/Users/Create');
    }

    /**
     * Store a newly created admin user.
     */
    public function store(Request $request): RedirectResponse
    {
        if (! $request->user()->isSuperAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Password::defaults()],
            'role' => 'required|string|in:super_admin,content_editor',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'User added successfully.');
    }

    /**
     * Show the form for editing the specified admin user.
     */
    public function edit(Request $request, User $user): Response
    {
        if (! $request->user()->isSuperAdmin()) {
            abort(403);
        }

        return Inertia::render('Admin/Users/Edit', [
            'adminUser' => $user,
        ]);
    }

    /**
     * Update the specified admin user.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        if (! $request->user()->isSuperAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', Password::defaults()],
            'role' => 'required|string|in:super_admin,content_editor',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User details updated.');
    }

    /**
     * Remove the specified admin user.
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        if (! $request->user()->isSuperAdmin()) {
            abort(403);
        }

        if ($request->user()->id === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted.');
    }
}
