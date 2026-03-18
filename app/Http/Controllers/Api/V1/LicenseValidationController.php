<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\License;
use App\Models\Product;

class LicenseValidationController extends Controller
{
    public function validateLicense(Request $request)
    {
        $request->validate([
            'license_key' => ['required', 'string'],
            'product_slug' => ['required', 'string'],
            'hardware_id' => ['nullable', 'string'],
            'device_name' => ['nullable', 'string'],
        ]);

        $product = Product::where('slug', $request->product_slug)->first();
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found.',
            ], 404);
        }

        $license = License::where('key', $request->license_key)
            ->where('product_id', $product->id)
            ->first();

        if (!$license) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid license key',
            ], 404);
        }

        if ($license->status !== 'active') {
            return response()->json([
                'status' => 'error',
                'message' => 'License is ' . $license->status . '.'
            ], 403);
        }

        if ($license->expires_at && $license->expires_at->isPast()) {
            return response()->json([
                'status' => 'error',
                'message' => 'License has expired.'
            ], 403);
        }

        $clientIdentifier = $request->hardware_id;

        if (empty($clientIdentifier)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Device Identifier (hardware_id) is required to count the activation.'
            ], 400);
        }

        $existingActivation = $license->activations()->where('hardware_identifier', $clientIdentifier)->first();

        if ($existingActivation) {

            $existingActivation->update(['last_active_at' => now()]);
        } else {
            $currentUsage = $license->activations()->count();

            if ($currentUsage >= $license->max_activations) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Activation limit reached. This license is already used by ' . $license->max_activations . ' device(s).'
                ], 403);
            }

            $license->activations()->create([
                'hardware_identifier' => $clientIdentifier,
                'device_name' => $request->device_name ?? 'Unknown Device',
                'last_active_at' => now(),
            ]);

            $license->update(['activations_count' => $currentUsage + 1]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'License is valid and authenticated.',
            'data' => [
                'product' => $product->name,
                'type' => $license->require_hardware_lock ? 'node-locked' : 'floating',
                'expires_at' => $license->expires_at ? $license->expires_at->toIso8601String() : 'lifetime',
            ]
        ], 200);
    }

    public function deactivateLicense(Request $request)
    {
        $request->validate([
            'license_key' => ['required', 'string'],
            'product_slug' => ['required', 'string'],
            'hardware_id' => ['required', 'string'],
        ]);

        $product = Product::where('slug', $request->product_slug)->first();
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found.',
            ], 404);
        }

        $license = License::where('key', $request->license_key)
            ->where('product_id', $product->id)
            ->first();

        if (!$license) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid license key.',
            ], 404);
        }

        $activation = $license->activations()->where('hardware_identifier', $request->hardware_id)->first();

        if (!$activation) {
            return response()->json([
                'status' => 'error',
                'message' => 'Device not found or already deactivated.'
            ], 404);
        }

        $activation->delete();

        $license->decrement('activations_count');

        return response()->json([
            'status' => 'success',
            'message' => 'License successfully deactivated for this device. The slot is now free.'
        ], 200);
    }
}
