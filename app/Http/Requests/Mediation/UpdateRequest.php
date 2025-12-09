<?php

namespace App\Http\Requests\Mediation;

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
            'title'            => 'sometimes|string|max:255',
            'date_at'          => 'sometimes|date',
            'author'           => 'sometimes|string|max:255',
            'category'         => 'sometimes|string|max:255',
            'mediation_status' => 'sometimes|in:draft,published,archived',
        ];
    }
}
