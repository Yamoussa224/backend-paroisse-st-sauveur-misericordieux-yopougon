<?php

namespace App\Http\Requests\Programmation;

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
            'name'        => 'required|string|max:255',
            'date_at'     => 'required|date',
            'started_at'  => 'required',
            'ended_at'    => 'nullable',
            'description' => 'required|string',
        ];
    }
}
