<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
} 