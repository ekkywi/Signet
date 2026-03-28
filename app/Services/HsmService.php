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

    public function generateProductIdentity(array $data)
    {
        try {
            $response = Http::timeout(30)->post("{$this->baseUrl}/api/hsm/generate-identity", [
                'command' => 'GENERATE_IDENTITY',
                'data' => $data,
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('[HSM PKI ERROR] Failed to generate identity. Response: ' . $response->body());
            return null;
        } catch (Exception $e) {
            Log::error('[HSM PKI ERROR] Connection to Node.js bridge failed: ' . $e->getMessage());
            return null;
        }
    }

    public function signPayLoad(array $payload, string $privateKey)
    {
        try {
            $response = Http::timeout(10)->post("{$this->baseUrl}/api/hsm/sign", [
                'command' => 'SIGN_PAYLOAD',
                'privateKey' => $privateKey,
                'payload' => $payload,
            ]);

            if ($response->successful()) {
                $result = $response->json();
                return $result['data']['signature'] ?? null;
            }

            Log::error('[HSM SIGN ERROR] Failed to sign payload. Response: ' . $response->body());
            return null;
        } catch (Exception $e) {
            Log::error('[HSM SIGN ERROR] Connection to Node.js bridge failed: ' . $e->getMessage());
            return null;
        }
    }
}
