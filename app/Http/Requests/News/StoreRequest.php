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
            'author'       => 'required|string|max:255',
            'category'     => 'required|string|max:255',
            'new_status'   => 'required|in:draft,published,archived',
            'published_at' => 'required|date',
        ];
    }
}
