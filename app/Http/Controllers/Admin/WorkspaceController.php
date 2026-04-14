<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workspace;

class WorkspaceController extends Controller
{
    public function index()
    {
        $workspaces = Workspace::with(['user', 'products', 'licenses'])->latest()->paginate(20);
        return view('admin.workspaces.index', compact('workspaces'));
    }
}
