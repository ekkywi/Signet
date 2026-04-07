<?php

namespace App\Services\Products;

use App\Models\Product;
use App\Models\Workspace;
use App\Services\Security\HsmService;
use Illuminate\Support\Str;
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
        $hsmResponse = $this->hsmService->generateProductIdentity($data['name']);

        if (!$hsmResponse || !isset($hsmResponse['wrapped_private_key']) || !isset($hsmResponse['certificate'])) {
            Log::error('[HSM PARSE ERROR] Invalid or incomplete response from HsmService.', [
                'product_name' => $data['name'],
            ]);
            throw new Exception('Hardware Security Error: HSM failed to respond or format is invalid.');
        }

        $product = $workspace->products()->create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']) . '-' . Str::random(5),
            'description' => $data['description'] ?? null,
            'wrapped_private_key' => $hsmResponse['wrapped_private_key'],
            'certificate' => $hsmResponse['certificate'],
        ]);

        Log::info('[DB SUCCESS] Product and keys securely generated for: ' . $data['name']);

        return $product;
    }
}
