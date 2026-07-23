<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string $role
 * @property string $status
 * @property Carbon|null $last_login_at
 * @property string|null $avatar
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property Carbon|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
#[Fillable(['name', 'email', 'password', 'role', 'status', 'last_login_at', 'avatar'])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if the user is a Super Admin.
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    /**
     * Check if the user is a Content Editor.
     */
    public function isContentEditor(): bool
    {
        return $this->role === 'content_editor';
    }

    /**
     * Check if the user is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if the user is inactive.
     */
    public function isInactive(): bool
    {
        return $this->status === 'inactive';
    }
}


