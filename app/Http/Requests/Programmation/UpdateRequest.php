<?php

namespace App\Http\Requests\Programmation;

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
            'name'        => 'sometimes|string|max:255',
            'date_at'     => 'sometimes|date',
            'started_at'  => 'sometimes',
            'ended_at'    => 'nullable',
            'description' => 'sometimes|string',
        ];
    }
}
