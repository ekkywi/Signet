<?php

namespace App\Http\Requests\AuditLog;

use Illuminate\Foundation\Http\FormRequest;

class AuditLogIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'export' => ['nullable', 'string', 'in:csv'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'start_date' => $this->input('start_date', now()->subDays(7)->format('Y-m-d')),
            'end_date' => $this->input('end_date', now()->format('Y-m-d')),
        ]);
    }

    public function wantsExport(): bool
    {
        return $this->input('export') === 'csv';
    }
}
