<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency_code',
        'currency_name',
        'symbol',
        'flag',
        'exchange_rate',
        'previous_rate',
        'live_rate',
        'manual_rate',
        'is_manual',
        'source',
        'is_active',
        'order',
        'last_updated_at',
    ];

    protected $casts = [
        'is_manual' => 'boolean',
        'is_active' => 'boolean',
        'exchange_rate' => 'float',
        'previous_rate' => 'float',
        'live_rate' => 'float',
        'manual_rate' => 'float',
        'order' => 'integer',
        'last_updated_at' => 'datetime',
    ];

    /**
     * Get trend direction indicator: 'up', 'down', or 'same'
     */
    public function getTrendAttribute(): string
    {
        if (is_null($this->previous_rate) || $this->previous_rate == 0) {
            return 'same';
        }

        $diff = round($this->exchange_rate - $this->previous_rate, 4);

        if ($diff > 0) {
            return 'up';
        } elseif ($diff < 0) {
            return 'down';
        }

        return 'same';
    }

    /**
     * Get percentage change relative to previous rate
     */
    public function getChangePercentageAttribute(): float
    {
        if (!$this->previous_rate || $this->previous_rate == 0) {
            return 0.0;
        }

        $diff = $this->exchange_rate - $this->previous_rate;
        return round(($diff / $this->previous_rate) * 100, 2);
    }

    protected $appends = ['trend', 'change_percentage'];
}
