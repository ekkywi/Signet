<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ApiKeyController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $workspace = $user->workspaces()->first();
        $apiKeys = $workspace->apiKeys()->latest()->get();

        return view('pages.apikeys.index', compact('user', 'workspace', 'apiKeys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $workspace = $user->workspaces()->first();
        $token = 'sgnt_live_' . Str::random(40);
        $workspace->apiKeys()->create([
            'name' => $request->name,
            'token' => $token,
        ]);

        return back()->with('success', 'New API key generated successfully.');
    }

    public function destroy($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $workspace = $user->workspaces()->first();
        $apiKey = $workspace->apiKeys()->where('id', $id)->firstOrFail();
        $apiKey->delete();

        return back()->with('success', 'API Key revoked successfully.');
    }
}
