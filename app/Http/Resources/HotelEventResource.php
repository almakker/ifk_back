<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HotelEventResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'datetime' => $this->datetime->format('Y-m-d H:i:s'),
            'event_type' => $this->event_type,
            'event_info' => $this->event_info,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'booking' => $this->when($this->booking, function() {
                return [
                    'id' => $this->booking->id,
                    'room_number' => $this->booking->room_number,
                    'check_in' => $this->booking->check_in->format('Y-m-d'),
                    'check_out' => $this->booking->check_out->format('Y-m-d'),
                    'status' => $this->booking->status,
                    'hotel' => [
                        'id' => $this->booking->hotel->id,
                        'name' => $this->booking->hotel->name,
                        'address' => $this->booking->hotel->address,
                    ],
                    'customers' => $this->booking->customers->map(function($customer) {
                        return [
                            'id' => $customer->id,
                            'name' => $customer->name,
                            'email' => $customer->email,
                            'phone' => $customer->phone,
                            'is_main' => $customer->pivot->is_main,
                        ];
                    }),
                ];
            }),
        ];
    }
} 