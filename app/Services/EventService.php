<?php

namespace App\Services;

use App\Models\Event;
use App\Repositories\EventRepository;
use App\Repositories\UserRepository;
use App\Repositories\BookingRepository;
use Faker\Factory;

class EventService
{
    protected $eventRepository;
    protected $userRepository;
    protected $bookingRepository;

    public function __construct(
        EventRepository $eventRepository,
        UserRepository $userRepository,
        BookingRepository $bookingRepository
    ) {
        $this->eventRepository = $eventRepository;
        $this->userRepository = $userRepository;
        $this->bookingRepository = $bookingRepository;
    }

    public function generateEvents()
    {
        $faker = Factory::create();
        $users = $this->userRepository->getStaffUsers();
        $bookings = $this->bookingRepository->getAll();
        
        foreach(range(1, 100) as $index) {
            $booking = $faker->optional(0.8)->randomElement($bookings);

            $this->eventRepository->create([
                'user_id' => $users->random()->id,
                'booking_id' => $booking ? $booking->id : null,
                'event_type' => $faker->randomElement(Event::EVENT_TYPES),
                'event_info' => $faker->sentence(),
                'datetime' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);
        }
    }
} 