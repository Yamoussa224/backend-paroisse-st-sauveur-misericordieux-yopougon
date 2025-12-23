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
            'image'        => 'sometimes|image|mimes:jpg,jpeg,png,webp|max:2048',
            'new_resume'   => 'sometimes|string|max:255',
            'location'     => 'sometimes|string|max:255',
            'content'      => 'sometimes|string',

            'new_status'   => 'sometimes|in:draft,published,archived',

            'views_count'  => 'sometimes|integer|min:0',
            'reads_count'  => 'sometimes|integer|min:0',

            'published_at' => 'sometimes|date',
        ];
    }
}
