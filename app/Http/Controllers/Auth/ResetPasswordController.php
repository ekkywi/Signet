<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Auth\AuthService;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index(Request $request, $token)
    {
        $email = $request->string('email')->toString();


        if (!$this->authService->isValidResetToken($email, $token)) {
            return redirect()->route('password.request')->withErrors(['email' => 'This password reset link is invalid or has expired. Please request a new one.']);
        }

        return view('auth.reset-password', [
            'token' => $token,
            'email' => $email,
        ]);
    }

    public function store(ResetPasswordRequest $request)
    {
        $status = $this->authService->resetPassword(
            $request->only('email', 'password', 'password_confirmation', 'token'),
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Your password has been reset successfully. You can now log in with your new password.');
        }

        return back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }
}
