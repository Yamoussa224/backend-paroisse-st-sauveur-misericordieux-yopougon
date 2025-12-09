<?php

namespace App\Http\Requests\TimeSlot;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'priest_id'   => 'required|integer|exists:users,id',
            'weekday'     => 'required|integer|min:0|max:6',
            'start_time'  => 'required',
            'end_time'    => 'required',
            'is_available'=> 'nullable|boolean',
        ];
    }
}
