<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'type',
        'heading',
        'subheading',
        'body',
        'order',
        'is_active',
        // CEO Message fields
        'ceo_rich_text',
        'ceo_name',
        'ceo_designation',
        'signature_media_id',
        'portrait_media_id',
        'show_ceo_image',
        'ceo_cta_button_text',
        'ceo_cta_button_url',
        // CTA Banner fields
        'cta_banner_heading',
        'cta_banner_subheading',
        'cta_background_media_id',
        'cta_primary_btn_text',
        'cta_primary_btn_url',
        'cta_secondary_btn_text',
        'cta_secondary_btn_url',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'show_ceo_image' => 'boolean',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(SectionItem::class)->orderBy('order');
    }

    public function portraitMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'portrait_media_id');
    }

    public function signatureMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'signature_media_id');
    }

    public function ctaBackgroundMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'cta_background_media_id');
    }
}
