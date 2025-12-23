<?php

namespace App\Http\Requests\News;

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
            'title'        => 'required|string|max:255',
            'image'        => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'new_resume'   => 'required|string|max:255',
            'location'     => 'required|string|max:255',
            'content'      => 'required|string',

            'new_status'   => 'required|in:draft,published,archived',

            'views_count'  => 'nullable|integer|min:0',
            'reads_count'  => 'nullable|integer|min:0',

            'published_at' => 'required|date',
        ];
    }
}
