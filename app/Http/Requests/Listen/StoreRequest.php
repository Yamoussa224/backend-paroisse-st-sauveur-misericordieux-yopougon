<?php

namespace App\Http\Requests\Listen;

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
            'type'          => 'nullable|string|max:100',
            'fullname'      => 'required|string|max:255',
            'phone'         => 'nullable|string|max:60',
            'message'       => 'required|string',
            'time_slot_id'  => 'required|integer|exists:time_slots,id',
            'listen_at'     => 'required|date',
        ];
    }
}
