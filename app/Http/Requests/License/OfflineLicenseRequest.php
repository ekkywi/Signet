<?php

namespace App\Http\Requests\License;

use Illuminate\Foundation\Http\FormRequest;

class OfflineLicenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'license_key' => ['required', 'string'],
            'hardware_id' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'license_key.required' => 'License key must be provided.',
            'hardware_id.required' => 'Hardware ID must be provided to lock the device.',
        ];
    }
}
