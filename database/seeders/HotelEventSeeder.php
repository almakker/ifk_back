<?php

namespace Database\Seeders;

use App\Services\HotelEventService;
use Illuminate\Database\Seeder;

class HotelEventSeeder extends Seeder
{
    protected $hotelEventService;

    public function __construct(HotelEventService $hotelEventService)
    {
        $this->hotelEventService = $hotelEventService;
    }

    public function run()
    {
        $this->hotelEventService->generateEvents();
    }
} 