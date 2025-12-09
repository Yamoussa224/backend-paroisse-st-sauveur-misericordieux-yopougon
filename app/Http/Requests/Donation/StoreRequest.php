<?php

namespace App\Http\Requests\Donation;

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
            'donator'         => 'required|string|max:100',
            'amount'          => 'required|numeric|min:0',
            'project'         => 'required|string|max:100',
            'paymethod'       => 'required|string|max:50',
            'paytransaction'  => 'required|string|max:50',
            'description'     => 'nullable|string',
            'donation_at'     => 'required|date',
        ];
    }
}
