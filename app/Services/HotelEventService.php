<?php

namespace App\Services;

use App\Models\Event;
use App\Repositories\HotelEventRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection as SupportCollection;
use Faker\Factory;

class HotelEventService
{
    private HotelEventRepository $hotelEventRepository;
    private UserRepository $userRepository;

    public function __construct(
        HotelEventRepository $hotelEventRepository,
        UserRepository $userRepository
    ) {
        $this->hotelEventRepository = $hotelEventRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Get filtered and paginated hotel events
     * @param array $filters 
     * @param array $pagination 
     * @return LengthAwarePaginator
     */
    public function getFilteredEvents(array $filters, array $pagination): LengthAwarePaginator
    {
        return $this->hotelEventRepository->getFilteredEvents($filters, $pagination);
    }

    /**
     * Get list of unique event types from the database
     * @return SupportCollection Collection of unique event type strings
     */
    public function getEventTypes(): SupportCollection
    {
        return $this->hotelEventRepository->getUniqueEventTypes();
    }

    /**
     * Get list of users with basic information
     * @return Collection 
     */
    public function getUsers(): Collection
    {
        $users = $this->userRepository->getBasicUsersList();

        if ($users->isEmpty()) {
            throw new ModelNotFoundException('No users found');
        }

        return $users;
    }

    public function generateEvents()
    {
        $faker = Factory::create();
        $users = $this->userRepository->getStaffUsers();

        foreach (range(1, 100) as $i) {
            $this->hotelEventRepository->create([
                'user_id' => $users->random()->id,
                'event_type' => Event::EVENT_TYPES[array_rand(Event::EVENT_TYPES)],
                'event_info' => $faker->sentence(),
                'datetime' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);
        }
    }
} 