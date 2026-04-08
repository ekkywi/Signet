<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\LicenseActivation;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->hasRole('super-admin')) {
            return redirect('/admin/dashboard');
        }

        $workspace = $user->workspaces()->first();

        if (!$workspace) {
            abort(404, 'No workspace found. Please create a workspace to access the dashboard.');
        }

        $totalProducts = $workspace->products()->count();
        $totalLicenses = $workspace->licenses()->count();
        $totalDevices = LicenseActivation::whereHas('license', function ($query) use ($workspace) {
            $query->where('workspace_id', $workspace->id);
        })->count();
        $recentActivations = LicenseActivation::with(['license.product'])
            ->whereHas('license', function ($query) use ($workspace) {
                $query->where('workspace_id', $workspace->id);
            })
            ->latest('last_active_at')
            ->take(5)
            ->get();

        return view('pages.dashboard', compact(
            'user',
            'workspace',
            'totalProducts',
            'totalLicenses',
            'totalDevices',
            'recentActivations'
        ));
    }
}
