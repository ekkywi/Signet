<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        try {
            $this->authService->registerUser($request->validated());

            session()->put('registered_email', $request->email);

            return redirect()->route('verification.notice')
                ->with('status', 'Registration successful! Please check your email to verify your account.');
        } catch (\Throwable $e) {
            Log::error('Registration failed: ' . $e->getMessage());

            return back()->withInput()->withErrors([
                'email' => 'Failed to register. Please try again later.',
            ]);
        }
    }
}
