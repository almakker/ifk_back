<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    public const TYPE_CHECK_IN = 'check_in';
    public const TYPE_CHECK_OUT = 'check_out';
    public const TYPE_ROOM_SERVICE = 'room_service';
    public const TYPE_CLEANING = 'cleaning';
    public const TYPE_MAINTENANCE = 'maintenance';

    public const EVENT_TYPES = [
        self::TYPE_CHECK_IN,
        self::TYPE_CHECK_OUT,
        self::TYPE_ROOM_SERVICE,
        self::TYPE_CLEANING,
        self::TYPE_MAINTENANCE,
    ];

    protected $fillable = [
        'user_id',
        'booking_id',
        'event_type',
        'event_info',
        'datetime'
    ];

    protected $casts = [
        'datetime' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::saving(function ($event) {
            if (!in_array($event->event_type, self::EVENT_TYPES)) {
                throw new \InvalidArgumentException('Invalid event type');
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
} 