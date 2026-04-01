<?php

namespace App\Http\Requests\License;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLicenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'expires_at' => ['nullable', 'date', 'after:today'],
        ];
    }
}
