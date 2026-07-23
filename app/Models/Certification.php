<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_name',
        'category',
        'issuing_organization',
        'issue_date',
        'expiry_date',
        'certificate_number',
        'short_description',
        'detailed_description',
        'official_website_url',
        'logo',
        'certificate_image',
        'certificate_pdf',
        'background_image',
        'order',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'order' => 'integer',
        'issue_date' => 'date:Y-m-d',
        'expiry_date' => 'date:Y-m-d',
    ];
}
