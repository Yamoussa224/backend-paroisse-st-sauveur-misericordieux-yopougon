<?php

namespace App\Http\Requests\TimeSlot;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'priest_id'   => 'sometimes|integer|exists:users,id',
            'weekday'     => 'sometimes|integer|min:0|max:6',
            'start_time'  => 'sometimes',
            'end_time'    => 'sometimes',
            'is_available'=> 'nullable|boolean',
        ];
    }
}
