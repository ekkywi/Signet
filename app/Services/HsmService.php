<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class HsmService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.hsm.url', 'http://hsm:3000');
    }

    public function isAlive(): bool
    {
        try {
            $response = Http::timeout(15)->get("{$this->baseUrl}/api/hsm/status");
            return $response->successful();
        } catch (Exception $e) {
            Log::warning('[HSM CHECK] Micro HSM is unreachable: ' . $e->getMessage());
            return false;
        }
    }

    public function generateProductIdentity(array $payload): ?array
    {
        try {
            $response = Http::timeout(10)->post("{$this->baseUrl}/api/hsm/generate-identity", [
                'command' => 'GENERATE_IDENTITY',
                'data' => $payload,
            ]);

            if ($response->successful() && $response->json('status') === 'success') {
                return [
                    'encrypted_private_key' => $response->json('data.encrypted_private_key'),
                    'certificate' => $response->json('data.certificate'),
                ];
            }

            Log::error('[HSM PKI ERROR] Failed to generate identity. Response: ' . $response->body());
            return null;
        } catch (Exception $e) {
            Log::error('[HSM PKI ERROR] Connection to Node.js bridge failed: ' . $e->getMessage());
            return null;
        }
    }
}
