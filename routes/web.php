<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\DashboardController as TenantDashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Pages\ApiKeyController;
use App\Http\Controllers\Pages\ProductController;
use App\Http\Controllers\Pages\LicenseController;
use App\Http\Controllers\Pages\OfflineLicenseController;
use App\Http\Controllers\Pages\AuditLogController as TenantAuditLogController;
use App\Http\Controllers\Pages\ProfileController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\HsmController;
use App\Http\Controllers\Admin\AuditLogController as AdminAuditLogController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES (Everyone Can Access)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/help', function () {
    return view('pages.public-docs');
})->name('help.index');

// Email Verification
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
Route::post('/email/resend-verification', [VerificationController::class, 'resend'])->middleware('throttle:6,1')->name('verification.send');


/*
|--------------------------------------------------------------------------
| 2. GUEST ROUTES (Only for users who are NOT logged in)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Authentication
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');

    // Registration
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    // Password Reset
    Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->middleware('throttle:3,1')->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'index'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('password.update');

    // Email Verification Notice
    Route::get('/email/verify-notice', [VerificationController::class, 'showNotice'])->name('verification.notice');
});


/*
|--------------------------------------------------------------------------
| 3. AUTH ROUTES (For users who are LOGGED IN but NOT necessarily verified)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| 4. ADMIN ROUTES (Only for users with 'super-admin' role)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:super-admin'])->group(function () {

    // Admin Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // HSM Status
    Route::prefix('hsm')->name('hsm.')->group(function () {
        Route::get('/', [HsmController::class, 'index'])->name('index');
        Route::post('/store', [HsmController::class, 'store'])->name('store');
        Route::put('/{hsmNode}', [HsmController::class, 'update'])->name('update');
        Route::delete('/{hsmNode}', [HsmController::class, 'destroy'])->name('destroy');
        Route::post('{hsmNode}/command', [HsmController::class, 'sendCommand'])->name('send-command');
    });

    // Audit Logs
    Route::get('/audit-logs', [AdminAuditLogController::class, 'index'])->name('logs.index');
});


/*
|--------------------------------------------------------------------------
| 5. PROTECTED SYSTEM ROUTES (Must be logged in AND email verified to access)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [TenantDashboardController::class, 'index'])->name('dashboard');

    // API Keys Management
    Route::get('/api-keys', [ApiKeyController::class, 'index'])->name('apikeys.index');
    Route::post('/api-keys', [ApiKeyController::class, 'store'])->name('apikeys.store');
    Route::delete('/api-keys/{id}', [ApiKeyController::class, 'destroy'])->name('apikeys.destroy');

    // Products Management
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{id}/certificate', [ProductController::class, 'downloadCert'])->name('products.download-cert');

    // Licenses Management
    Route::get('/licenses', [LicenseController::class, 'index'])->name('licenses.index');
    Route::post('/licenses', [LicenseController::class, 'store'])->name('licenses.store');
    Route::delete('/licenses/{id}', [LicenseController::class, 'destroy'])->name('licenses.destroy');
    Route::get('/licenses/{id}', [LicenseController::class, 'show'])->name('licenses.show');
    Route::delete('/licenses/activations/{id}', [LicenseController::class, 'revokeDevice'])->name('licenses.revoke-device');
    Route::put('/licenses/{id}', [LicenseController::class, 'update'])->name('licenses.update');

    // Offline Licenses Management
    Route::get('/offline-licenses', [OfflineLicenseController::class, 'index'])->name('offline-licenses.index');
    Route::post('/offline-licenses', [OfflineLicenseController::class, 'store'])->name('offline-licenses.store');

    // Audit Logs
    Route::get('/logs', [TenantAuditLogController::class, 'index'])->name('logs.index');

    // API Documentation (Internal)
    Route::get('/docs', function () {
        return view('pages.docs');
    })->name('docs');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
