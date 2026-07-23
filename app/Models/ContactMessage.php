<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'is_read',
        'data',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'data' => 'array',
    ];

    /**
     * Accessor for service_interest extracted from dynamic JSON data.
     */
    public function getServiceInterestAttribute(): ?string
    {
        if (is_array($this->data)) {
            return $this->data['service_interest'] ?? $this->data['service'] ?? null;
        }
        return null;
    }
}
