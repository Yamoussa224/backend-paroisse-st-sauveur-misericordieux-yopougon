<?php

namespace App\Http\Requests\ParticipantEvent;

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
            'fullname' => 'required|string|max:255',
            'email'    => 'nullable|email|max:255',
            'phone'    => 'nullable|string|max:255',
            'message'  => 'nullable|string',
            'event_id' => 'required|integer|exists:events,id',
        ];
    }
}
