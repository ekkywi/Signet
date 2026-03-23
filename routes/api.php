<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\LicenseValidationController;
use App\Http\Middleware\VerifyApiKey;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::middleware([VerifyApiKey::class, 'throttle:60,1'])->group(function () {
        Route::post('/licenses/validate', [LicenseValidationController::class, 'validateLicense']);
        Route::post('/licenses/deactivate', [LicenseValidationController::class, 'deactivateLicense']);
    });
});
