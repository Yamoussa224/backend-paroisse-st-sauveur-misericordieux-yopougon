<?php

namespace App\Http\Requests\Pastor;

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
            'fullname'    => 'required|string|max:150',
            'started_at'  => 'required|date',
            'ended_at'    => 'nullable|date',
            'description' => 'required|string',
        ];
    }
}
