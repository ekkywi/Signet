<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ImpersonationController extends Controller
{
    public function impersonate(User $user)
    {
        if (Auth::id() === $user->id) {
            return redirect()->back()->with('error', 'You cannot impersonate yourself.');
        }

        session()->put('impersonate_admin_id', Auth::id());

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', "You are now impersonating {$user->name}.");
    }

    public function leave()
    {
        $adminId = session()->get('impersonate_admin_id');

        if (!$adminId) {
            return redirect()->route('login');
        }

        $admin = User::find($adminId);

        Auth::login($admin);
        session()->forget('impersonate_admin_id');

        return redirect()->route('admin.workspaces.index')->with('success', 'You have stopped impersonating and returned to your admin account.');
    }
}
