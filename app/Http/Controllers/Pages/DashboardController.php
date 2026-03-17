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
            'api_calls' => 0,
            'revoked_licenses' => 0,
        ];

        $recentLicenses = [];

        return view('dashboard', compact('user', 'workspace', 'stats', 'recentLicenses'));
    }
}
