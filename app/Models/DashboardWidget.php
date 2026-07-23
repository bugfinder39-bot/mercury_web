<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DashboardWidget extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'widget_key',
        'title',
        'subtitle',
        'icon',
        'bg_style',
        'chart_type',
        'size',
        'display_order',
        'refresh_interval',
        'animation',
        'is_enabled',
        'permission_role',
        'custom_settings',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'display_order' => 'integer',
        'refresh_interval' => 'integer',
        'custom_settings' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
