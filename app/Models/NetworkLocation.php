<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country',
        'city',
        'region',
        'type',
        'latitude',
        'longitude',
        'address',
        'google_maps_url',
        'phone',
        'email',
        'website',
        'description',
        'order',
        'is_active',
        'is_featured',
        'marker_color',
        'marker_icon',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'latitude' => 'float',
        'longitude' => 'float',
        'order' => 'integer',
    ];
}
