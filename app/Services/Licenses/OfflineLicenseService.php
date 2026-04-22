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
            throw new Exception('License is not active or has been revoked.');
        }

        $existingActivation = $license->activations()->where('hardware_id', $hardwareId)->first();

        if (!$existingActivation) {
            if ($license->activations()->count() >= $license->max_activations) {
                throw new Exception("Activation limit reached. This license only allows {$license->max_activations} devices.");
            }

            $license->activations()->create([
                'hardware_id' => $hardwareId,
            ]);
        }

        $expiresAt = $license->expires_at ? $license->expires_at->toIso8601String() : Carbon::now()->addYears(100)->toIso8601String();

        $payload = [
            'expires_at'    => $expiresAt,
            'hardware_id'   => $hardwareId,
            'license_key'   => $license->key,
            'product'       => $license->product->slug,
            'timestamp'     => now()->timestamp,
        ];

        ksort($payload);

        $jsonPayloadString = json_encode($payload);

        $wrappedKey = $license->product->wrapped_private_key;

        $signature = Cache::lock('hsm-usb-lock', 15)->block(15, function () use ($jsonPayloadString, $wrappedKey) {

            $hsmResponse = $this->hsmService->signPayload([
                'cmd'   => 'SIGN_DATA',
                'data'  => [
                    'wrapped_private_key' => $wrappedKey,
                    'payload' => $jsonPayloadString
                ]
            ]);

            if (!$hsmResponse || $hsmResponse['status'] !== 'OK') {
                return null;
            }

            return $hsmResponse['data']['signature'];
        });

        if (!$signature) {
            Log::error('[OFFLINE LICENSE] HSM Error or Timeout for license key: ' . $license->id);
        }

        $fileName = 'license_' . substr($hardwareId, 0, 8) . '.json';

        $licenseData = [
            'status'    => 'success',
            'payload'   => $payload,
            'signature' => $signature,
        ];

        return [
            'fileName' => $fileName,
            'fileData' => json_encode($licenseData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
        ];
    }
}
