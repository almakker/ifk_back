<?php

namespace App\Repositories;

use App\Models\Event;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as SupportCollection;
use App\Models\HotelEvent;

class HotelEventRepository
{
    private Event $model;

    public function __construct(Event $model)
    {
        $this->model = $model;
    }

    /**
     * Get filtered and paginated hotel events
     *
     * @param array $filters
     * @param array $pagination 
     * @return LengthAwarePaginator 
     */
    public function getFilteredEvents(array $filters, array $pagination): LengthAwarePaginator
    {
        return $this->model->with(['user', 'booking.customers', 'booking.hotel'])
            ->when($filters['dateRange'] ?? null, function ($q) use ($filters) {
                $q->whereBetween('datetime', $filters['dateRange']);
            })
            ->when($filters['userId'] ?? null, function ($q) use ($filters) {
                $q->where('user_id', $filters['userId']);
            })
            ->when($filters['eventType'] ?? null, function ($q) use ($filters) {
                $q->where('event_type', $filters['eventType']);
            })
            ->when($filters['sortBy'] ?? null, function ($q) use ($filters) {
                $q->orderBy($filters['sortBy'], $filters['sortDesc'] ? 'desc' : 'asc');
            }, function ($q) {
                $q->orderBy('datetime', 'desc');
            })
            ->paginate($pagination['perPage'], ['*'], 'page', $pagination['page']);
    }

    /**
     * Get list of unique event types from the database
     * @return SupportCollection
     */
    public function getUniqueEventTypes(): SupportCollection
    {
        return $this->model->query()
            ->select('event_type')
            ->distinct()
            ->pluck('event_type');
    }

    public function create(array $data)
    {
        return HotelEvent::create($data);
    }
} 