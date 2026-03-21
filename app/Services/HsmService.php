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

    public function signPayload(array $payload): ?string
    {
        try {
            $response = Http::timeout(5)->post("{$this->baseUrl}/api/hsm/sign", [
                'data' => json_encode($payload)
            ]);

            if ($response->successful() && $response->json('status') === 'success') {
                return $response->json('signature');
            }

            Log::error('[HSM SIGN ERROR] Failed to sign payload. Response: ' . $response->body());
            return null;
        } catch (Exception $e) {
            Log::error('[HSM BRIDGE ERROR] Connection to Node.js bridge failed: ' . $e->getMessage());
            return null;
        }
    }
}
