<?php

namespace App\Http\Requests\License;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLicenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var \App\Models\User $user */
        $user = $this->user();
        $workspace = $user->workspaces()->first();

        return [
            'product_id' => [
                'required',
                Rule::exists('products', 'id')->where('workspace_id', $workspace->id)
            ],
            'max_activations' => ['required', 'integer', 'min:1'],
            'expires_at' => ['nullable', 'date', 'after:today'],
            'require_hardware_lock' => ['nullable'],
        ];
    }
}
