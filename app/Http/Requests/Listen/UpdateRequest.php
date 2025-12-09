<?php

namespace App\Http\Requests\Listen;

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
            'type'          => 'nullable|string|max:100',
            'fullname'      => 'sometimes|string|max:255',
            'phone'         => 'nullable|string|max:60',
            'message'       => 'sometimes|string',
            'time_slot_id'  => 'sometimes|integer|exists:time_slots,id',
            'listen_at'     => 'sometimes|date',
        ];
    }
}
