<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function index(Request $request, $token)
    {
        $email = $request->string('email')->toString();

        $user = User::where('email', $email)->first();

        if (!$user || ! Password::broker()->tokenExists($user, $token)) {
            return redirect()->route('password.request')->withErrors(['email' => 'This password reset link is invalid or has expired. Please request a new one.']);
        }

        return view('auth.reset-password', [
            'token' => $token,
            'email' => $email,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:12'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),

            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Your password has been reset successfully. You can now log in with your new password.');
        }

        return back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }
}
