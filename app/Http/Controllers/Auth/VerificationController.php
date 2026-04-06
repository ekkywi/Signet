<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;

class VerificationController extends Controller
{
    public function showNotice(Request $request)
    {
        $email = session('registered_email');

        if (!$email) {
            return redirect()->route('login');
        }

        return view('auth.verify-email', ['email' => $email]);
    }

    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403, 'Invalid or expired verification link.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('dashboard')->with('status', 'Your email is already verified. You can now log in.');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->route('login')->with('status', 'Your email has been verified! You can now log in.');
    }

    public function resend(Request $request)
    {
        $request->validate(['email' => ['required', 'email']]);
        $user = User::where('email', $request->email)->first();

        if ($user && !$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
            return back()->with('status', 'New verification email sent! Please check your inbox.');
        }

        return back()->withErrors(['email' => 'Email address not found or email already verified.']);
    }
}
