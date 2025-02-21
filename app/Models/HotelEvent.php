<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HotelEvent extends Model
{
    protected $fillable = [
        'user_id',
        'event_type',
        'event_info',
        'datetime'
    ];

    protected $casts = [
        'datetime' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
} 