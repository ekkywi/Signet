<?php

namespace App\Services\Licenses;

use App\Models\License;
use App\Models\Product;
use App\Models\Workspace;
use App\Models\LicenseActivation;
use App\Services\Security\HsmService;

class LicenseService
{
    protected HsmService $hsmService;

    public function __construct(HsmService $hsmService)
    {
        $this->hsmService = $hsmService;
    }

    public function createLicense(Workspace $workspace, array $data): License
    {
        $pool = '23456789ABCDEFGHJKMNPQRSTUVWXYZ';

        $randomString = substr(str_shuffle(str_repeat($pool, 5)), 0, 25);
        $key = implode('-', str_split($randomString, 5));

        $product = Product::findOrFail($data['product_id']);

        $payloadData = [
            'serial'    => $key,
            'product'   => $product->slug,
            'expires'   => $data['expires_at'] ?? 'never',
            'hw_lock'   => $data['require_hardware_lock'] ? 'yes' : 'no'
        ];

        ksort($payloadData);

        $payload = json_encode($payloadData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $payloadHash = hash('sha256', $payload);

        $signature = $this->hsmService->signLicense(
            $product->wrapped_private_key,
            $product->iv,
            $product->auth_tag,
            $payloadHash
        );

        $license = $workspace->licenses()->create([
            'product_id'            => $product->id,
            'key'                   => $key,
            'status'                => 'active',
            'require_hardware_lock' => $data['require_hardware_lock'] ?? false,
            'max_activations'       => $data['max_activations'],
            'expires_at'            => $data['expires_at'],
            'signature'             => $signature,
            'signed_payload'        => $payload
        ]);

        return $license->loadCount('activations');
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
