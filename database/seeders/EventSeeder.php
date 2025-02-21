<?php

namespace Database\Seeders;

use App\Services\EventService;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function run()
    {
        $this->eventService->generateEvents();
    }
} 