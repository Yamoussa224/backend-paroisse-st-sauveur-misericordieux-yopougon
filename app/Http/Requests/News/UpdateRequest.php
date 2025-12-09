<?php

namespace App\Http\Requests\News;

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
            'title'        => 'sometimes|string|max:255',
            'author'       => 'sometimes|string|max:255',
            'category'     => 'sometimes|string|max:255',
            'new_status'   => 'sometimes|in:draft,published,archived',
            'published_at' => 'sometimes|date',
        ];
    }
}
