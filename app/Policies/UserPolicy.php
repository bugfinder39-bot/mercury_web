<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any users.
     */
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can view the specific user.
     */
    public function view(User $user, User $model): bool
    {
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can create users.
     */
    public function create(User $user): bool
    {
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can update the target user.
     */
    public function update(User $user, User $model): bool
    {
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can delete the target user.
     */
    public function delete(User $user, User $model): bool
    {
        // Content Editor cannot delete users
        if (! $user->isSuperAdmin()) {
            return false;
        }

        // Cannot delete self
        if ($user->id === $model->id) {
            return false;
        }

        // Cannot delete the last Super Admin
        if ($model->isSuperAdmin()) {
            $superAdminCount = User::where('role', 'super_admin')->count();
            if ($superAdminCount <= 1) {
                return false;
            }
        }

        return true;
    }

    /**
     * Determine whether the user can toggle the status of the target user.
     */
    public function toggleStatus(User $user, User $model): bool
    {
        if (! $user->isSuperAdmin()) {
            return false;
        }

        if ($user->id === $model->id) {
            return false; // Cannot deactivate self
        }

        if ($model->isSuperAdmin()) {
            $superAdminCount = User::where('role', 'super_admin')->where('status', 'active')->count();
            if ($superAdminCount <= 1 && $model->status === 'active') {
                return false; // Cannot deactivate the last active super admin
            }
        }

        return true;
    }
}

