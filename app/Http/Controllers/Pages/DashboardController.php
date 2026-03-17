<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $workspace = $user->workspaces()->first();

        $stats = [
            'active_licenses' => 0,
            'total_api_keys' => $workspace->apiKeys()->count(),
            'revoked_licenses' => 0,
        ];

        $recentLicenses = [];

        return view('pages.dashboard', compact('user', 'workspace', 'stats', 'recentLicenses'));
    }
}
