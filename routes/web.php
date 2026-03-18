<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Pages\ApiKeyController;
use App\Http\Controllers\Pages\ProductController;
use App\Http\Controllers\Pages\LicenseController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('password.request');

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // API Keys Management
    Route::get('/api-keys', [ApiKeyController::class, 'index'])->name('apikeys.index');
    Route::post('/api-keys', [ApiKeyController::class, 'store'])->name('apikeys.store');
    Route::delete('/api-keys/{id}', [ApiKeyController::class, 'destroy'])->name('apikeys.destroy');

    // Products Management
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Licenses Management
    Route::get('/licenses', [LicenseController::class, 'index'])->name('licenses.index');
    Route::post('/licenses', [LicenseController::class, 'store'])->name('licenses.store');
    Route::delete('/licenses/{id}', [LicenseController::class, 'destroy'])->name('licenses.destroy');
    Route::get('/licenses/{id}', [LicenseController::class, 'show'])->name('licenses.show');
    Route::delete('/licenses/activations/{id}', [LicenseController::class, 'revokeDevice'])->name('licenses.revoke-device');
});
