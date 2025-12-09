<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Au moins l'un des deux doit être présent
            'email'    => 'nullable|string|email|exists:users,email|required_without:phone',
            'phone'    => 'nullable|string|exists:users,phone|required_without:email',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required_without' => 'Vous devez fournir soit un email, soit un numéro de téléphone.',
            'phone.required_without' => 'Vous devez fournir soit un email, soit un numéro de téléphone.',
        ];
    }
}
