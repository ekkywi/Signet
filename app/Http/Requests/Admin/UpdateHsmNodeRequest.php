<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHsmNodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $hsmNode = $this->route('hsmNode');

        return [
            'name' => ['required', 'string', 'max:255', 'unique:hsm_nodes,name,' . $hsmNode->id],
            'host_path' => ['required', 'string', 'max:255'],
            'is_primary' => ['nullable'],
        ];
    }
}
