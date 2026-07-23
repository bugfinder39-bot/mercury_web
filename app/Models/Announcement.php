<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_description',
        'full_description',
        'type',
        'priority',
        'bg_color',
        'text_color',
        'icon',
        'button_text',
        'button_url',
        'display_order',
        'is_active',
        'is_pinned',
        'is_dismissible',
        'start_date',
        'end_date',
        'display_location',
        'target_pages',
        'specific_pages',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_pinned' => 'boolean',
        'is_dismissible' => 'boolean',
        'display_order' => 'integer',
        'specific_pages' => 'array',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Get active public announcements that meet date and location constraints.
     */
    public static function getPublicAnnouncements()
    {
        $now = Carbon::now();

        return self::where('is_active', true)
            ->where(function ($q) use ($now) {
                $q->whereNull('start_date')
                  ->orWhere('start_date', '<=', $now);
            })
            ->where(function ($q) use ($now) {
                $q->whereNull('end_date')
                  ->orWhere('end_date', '>=', $now);
            })
            ->orderBy('is_pinned', 'desc')
            ->orderBy('display_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
