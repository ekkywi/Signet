<?php

namespace App\Services\Licenses;

use App\Models\License;
use App\Models\Workspace;
use App\Models\LicenseActivation;
use Illuminate\Support\Str;

class LicenseService
{
    public function createLicense(Workspace $workspace, array $data): License
    {
        $pool = '23456789ABCDEFGHJKMNPQRSTUVWXYZ';

        $randomString = substr(str_shuffle(str_repeat($pool, 5)), 0, 25);
        $key = implode('-', str_split($randomString, 5));

        return $workspace->licenses()->create([
            'product_id' => $data['product_id'],
            'key' => $key,
            'status' => 'active',
            'require_hardware_lock' => $data['require_hardware_lock'] ?? false,
            'max_activations' => $data['max_activations'],
            'expires_at' => $data['expires_at'],
        ]);
    }

    public function updateLicense(Workspace $workspace, string $id, array $data): License
    {
        $license = $workspace->licenses()->findOrFail($id);
        $license->update(['expires_at' => $data['expires_at'] ?? null]);

        return $license;
    }

    public function deleteLicense(Workspace $workspace, string $id): void
    {
        $license = $workspace->licenses()->findOrFail($id);
        $license->delete();
    }

    public function revokeDevice(Workspace $workspace, string $activationId): void
    {
        $activation = LicenseActivation::whereHas('license', function ($query) use ($workspace) {
            $query->where('workspace_id', $workspace->id);
        })->where('id', $activationId)->firstOrFail();

        $activation->delete();
    }
}
