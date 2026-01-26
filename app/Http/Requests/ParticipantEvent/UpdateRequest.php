<?php

namespace App\Http\Requests\ParticipantEvent;

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
            'fullname' => 'sometimes|string|max:255',
            'email'    => 'nullable|email|max:255',
            'phone'    => 'nullable|string|max:255',
            'message'  => 'nullable|string',
            'event_id' => 'sometimes|integer|exists:events,id',
        ];
    }
}
