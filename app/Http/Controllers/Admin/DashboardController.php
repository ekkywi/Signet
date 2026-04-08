<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Workspace;
use App\Models\License;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalWorkspaces = Workspace::count();
        $totalLicenses = License::count();

        return view('admin.dashboard', compact('totalUsers', 'totalWorkspaces', 'totalLicenses'));
    }
}
