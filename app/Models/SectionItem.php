<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SectionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'title',
        'subtitle',
        'description',
        'value',
        'icon',
        'link',
        'order',
        'is_active',
        // Image Gallery fields
        'image_media_id',
        'alt_text',
        // Office location fields
        'address',
        'map_url',
        'phone',
        'email',
        'office_hours',
        'emergency_contact',
        'latitude',
        'longitude',
        // Team member fields
        'designation',
        'department',
        'office_location',
        'mobile',
        'whatsapp',
        'extension',
        'linkedin_url',
        'facebook_url',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function imageMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_media_id');
    }
}
