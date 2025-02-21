<?php

namespace App\Http\Controllers;

use App\Http\Resources\HotelEventCollection;
use App\Http\Resources\UserCollection;
use App\Http\Requests\HotelEventIndexRequest;
use App\Services\HotelEventService;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HotelEventController extends Controller
{
    private HotelEventService $hotelEventService;

    public function __construct(HotelEventService $hotelEventService)
    {
        $this->hotelEventService = $hotelEventService;
    }

    /**
     * Get paginated list of hotel events with filters
     */
    public function index(HotelEventIndexRequest $request): HotelEventCollection
    {
        try {
            $filters = [
                'dateRange' => $request->dateRange,
                'userId' => $request->userId,
                'eventType' => $request->eventType,
                'sortBy' => $request->sortBy,
                'sortDesc' => $request->sortDesc,
            ];

            $pagination = [
                'page' => $request->page,
                'perPage' => $request->perPage,
            ];

            $events = $this->hotelEventService->getFilteredEvents($filters, $pagination);

            return new HotelEventCollection($events);

        } catch (Exception $e) {
            throw new Exception('Failed to fetch hotel events: ' . $e->getMessage());
        }
    }

    /**
     * Get list of unique event types
     */
    public function types(): JsonResponse
    {
        try {
            $types = $this->hotelEventService->getEventTypes();
            return response()->json($types);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'An unexpected error occurred'
            ], 500);
        }
    }

    /**
     * Get list of users with basic information
     */
    public function users(): UserCollection
    {
        try {
            $users = $this->hotelEventService->getUsers();
            return new UserCollection($users);

        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException(
                'Failed to fetch users: ' . $e->getMessage()
            );
        }
    }
} 