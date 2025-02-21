<?php

namespace App\Repositories;

use App\Models\Event;
use App\Models\Booking;

class EventRepository
{
    private Event $model;

    public function __construct(Event $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function getAllBookings()
    {
        return Booking::all();
    }
} 