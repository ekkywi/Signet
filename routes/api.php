<?php

use App\Http\Controllers\Api\HsmBridgeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\LicenseValidationController;
use App\Http\Controllers\Api\Internal\HsmPingController;
use App\Http\Middleware\VerifyApiKey;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API Version 1 Routes
Route::prefix('v1')->group(function () {
    Route::middleware([VerifyApiKey::class, 'throttle:60,1'])->group(function () {
        Route::post('/licenses/validate', [LicenseValidationController::class, 'validateLicense']);
        Route::post('/licenses/deactivate', [LicenseValidationController::class, 'deactivateLicense']);
    });
});

// Internal Route for HSM
Route::prefix('hsm')->group(function () {
    Route::post('/enroll', [HsmBridgeController::class, 'enroll']);
});

Route::prefix('internal/hsm')->middleware('verify.hsm.node')->group(function () {
    Route::post('/ping', [HsmPingController::class, 'ping']);
});
