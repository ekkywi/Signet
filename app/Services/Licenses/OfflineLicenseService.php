<?php

namespace App\Services\Licenses;

use App\Models\License;
use App\Services\Security\HsmService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Exception;

class OfflineLicenseService
{
    protected HsmService $hsmService;

    public function __construct(HsmService $hsmService)
    {
        $this->hsmService = $hsmService;
    }

    public function generate(string $licenseKey, string $hardwareId): array
    {
        $license = License::with('product')->where('key', $licenseKey)->first();

        if (!$license) {
            throw new Exception('License not found in the system.');
        }

        if ($license->status !== 'active') {
            throw new Exception('This license is not active or has been revoked.');
        }

        if ($license->hardware_id) {
            if ($license->hardware_id !== $hardwareId) {
                throw new Exception('This license is already locked to a different Hardware ID.');
            }
        } else {
            $license->update(['hardware_id' => $hardwareId]);
        }

        $expiresAt = $license->expires_at
            ? $license->expires_at->toIso8601String()
            : Carbon::now()->addYears(100)->toIso8601String();

        $payload = [
            'expires_at'  => $expiresAt,
            'hardware_id' => $hardwareId,
            'license_key' => $license->key,
            'product'     => $license->product->slug,
            'timestamp'   => now()->timestamp,
        ];

        ksort($payload);

        $privateKey = $license->product->private_key;

        $signature = Cache::lock('hsm-usb-port', 15)->block(15, function () use ($payload, $privateKey) {
            return $this->hsmService->signPayLoad($payload, $privateKey);
        });

        if (!$signature) {
            Log::error('[OFFLINE LICENSE] Failed to get signature from HSM for license ' . $license->id);
            throw new Exception('Connection to Cryptographic Hardware is failed or lost.');
        }

        $fileName = 'license_' . substr($hardwareId, 0, 8) . '.json';

        $licenseData = [
            'status' => 'success',
            'payload' => $payload,
            'signature' => $signature,
        ];

        return [
            'fileName' => $fileName,
            'fileData' => json_encode($licenseData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
        ];
    }
}
