<?php

namespace App\Services\Products;

use App\Models\Product;
use App\Models\Workspace;
use App\Services\Security\HsmService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Exception;

class ProductService
{
    protected HsmService $hsmService;

    public function __construct(HsmService $hsmService)
    {
        $this->hsmService = $hsmService;
    }

    public function createProduct(Workspace $workspace, array $data): Product
    {
        $hsmResponse = $this->hsmService->generateProductIdentity([
            'product_name' => $data['name'],
            'organization' => 'Signet Cloud KMS',
        ]);

        if (!$hsmResponse || !isset($hsmResponse['data']['raw_private_key']) || !isset($hsmResponse['data']['certificate'])) {
            Log::error('[HSM PARSE ERROR] Invalid or incomplete JSON structure from Hardware.', [
                'product_name' => $data['name'],
            ]);
            throw new Exception('Hardware Security Error: HSM failed to respond or format is invalid.');
        }

        $product = $workspace->products()->create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']) . '-' . Str::random(5),
            'description' => $data['description'] ?? null,
            'private_key' => Crypt::encryptString($hsmResponse['data']['raw_private_key']),
            'certificate' => $hsmResponse['data']['certificate'],
        ]);

        Log::info('[DB SUCCESS] Product and keys securely generated and saved for: ' . $data['name']);

        return $product;
    }
}
