<?php

namespace App\Http\Requests\User;

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
            'fullname'           => 'sometimes|string|max:255',
            'email'              => 'nullable|email|max:100|unique:users,email,' . $this->id,
            'phone'              => 'sometimes|string|max:100|unique:users,phone,' . $this->id,
            'password'           => ($this->id ? 'nullable' : 'sometimes') . '|string|min:6',
            'status'             => 'sometimes|in:ENABLE,DISABLE',
            'photo'              => 'nullable|string|max:255',
            'role'               => 'nullable|in:ADMIN,PRIEST',
            'email_verified_at'  => 'nullable|date',
        ];
    }
}
