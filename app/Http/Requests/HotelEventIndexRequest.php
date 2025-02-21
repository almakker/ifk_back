<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelEventIndexRequest extends FormRequest
{
    public function rules()
    {
        return [
            'dateRange' => 'nullable|array|size:2',
            'dateRange.*' => 'nullable|date',
            'userId' => 'nullable|exists:users,id',
            'eventType' => 'nullable|string',
            'page' => 'required|integer|min:1',
            'perPage' => 'required|integer|min:1|max:100',
            'sortBy' => 'nullable|string|in:datetime,event_type,event_info',
            'sortDesc' => 'nullable|in:true,false,0,1'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'sortDesc' => $this->sortDesc === 'true' || $this->sortDesc === '1'
        ]);
    }
} 