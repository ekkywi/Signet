<?php

namespace App\Services\Security;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HsmService
{
    protected string $baseUrl = 'http://hsm:3000/api/hsm';

    public function generateProductIdentity(string $productName): array
    {
        try {
            $response = Http::timeout(30)->post("{$this->baseUrl}/generate", [
                'product_name' => $productName
            ]);

            if ($response->failed() || $response->json('status') !== 'success') {
                throw new Exception("HSM API Error: " . ($response->json('message') ?? 'Unknown error'));
            }

            $data = $response->json('data');

            return [
                'wrapped_private_key' => $data['wrapped_private_key'],
                'certificate'         => $data['certificate']
            ];
        } catch (Exception $e) {
            Log::error("HSM Generation Failed: " . $e->getMessage());
            throw new Exception("Failed to communicate with HSM for product identity generation.");
            // throw new Exception("HSM ERROR ASLI: " . $e->getMessage());
        }
    }

    public function signLicense(string $wrappedKey, string $payloadString): string
    {
        try {
            $response = Http::timeout(30)->post("{$this->baseUrl}/sign", [
                'wrapped_private_key' => $wrappedKey,
                'payload'             => $payloadString
            ]);

            if ($response->failed() || $response->json('status') !== 'success') {
                throw new Exception("HSM API Error: " . ($response->json('message') ?? 'Unknown error'));
            }

            return $response->json('data')['signature'];
        } catch (Exception $e) {
            Log::error("HSM Signing Failed: " . $e->getMessage());
            throw new Exception("Failed to sign license via HSM.");
            // throw new Exception("HSM ERROR ASLI: " . $e->getMessage());
        }
    }
}
