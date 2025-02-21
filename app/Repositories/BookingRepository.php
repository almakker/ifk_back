<?php

namespace App\Repositories;

use App\Models\Booking;

class BookingRepository
{
    private Booking $model;

    public function __construct(Booking $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }
} 