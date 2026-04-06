<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;

class AuthService
{
    public function attemptLogin(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }

    public function logout(): void
    {
        Auth::logout();
    }

    public function registerUser(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $firstName = explode(' ', trim($data['name']))[0];
            Workspace::create([
                'user_id' => $user->id,
                'name' => $firstName . "'s Workspace",
            ]);

            event(new Registered($user));

            return $user;
        });
    }

    public function sendPasswordResetLink(array $credentials): string
    {
        return Password::sendResetLink($credentials);
    }

    public function isValidResetToken(string $email, string $token): bool
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return false;
        }

        return Password::broker()->tokenExists($user, $token);
    }

    public function resetPassword(array $credentials): string
    {
        return Password::reset(
            $credentials,
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );
    }
}
