<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Product;
use App\Models\License;
use App\Models\LicenseActivation;

class LicenseController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $workspace = $user->workspaces()->first();
        $products = $workspace->products()->orderBy('name')->get();
        $licenses = $workspace->licenses()->with('product')->latest()->get();

        return view('pages.licenses.index', compact('user', 'workspace', 'products', 'licenses'));
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $workspace = $user->workspaces()->first();

        $request->validate([
            'product_id' => [
                'required',
                Rule::exists('products', 'id')->where('workspace_id', $workspace->id)
            ],
            'max_activations' => ['required', 'integer', 'min:1'],
            'expires_at' => ['nullable', 'date', 'after:today'],
        ]);

        $key =
            Str::upper(Str::random(5)) . '-' .
            Str::upper(Str::random(5)) . '-' .
            Str::upper(Str::random(5)) . '-' .
            Str::upper(Str::random(5)) . '-' .
            Str::upper(Str::random(5));

        $workspace->licenses()->create([
            'product_id' => $request->product_id,
            'key' => $key,
            'status' => 'active',
            'require_hardware_lock' => $request->has('require_hardware_lock'),
            'max_activations' => $request->max_activations,
            'expires_at' => $request->expires_at,
        ]);

        return back()->with('success', 'License key generated: ' . $key);
    }

    public function destroy($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $workspace = $user->workspaces()->first();
        $license = $workspace->licenses()->where('id', $id)->firstOrFail();
        $license->delete();

        return back()->with('success', 'License revoked and deleted.');
    }

    public function show($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $workspace = $user->workspaces()->first();
        $license = $workspace->licenses()
            ->with(['product', 'activations' => function ($query) {
                $query->latest('last_active_at');
            }])
            ->where('id', $id)
            ->firstOrFail();

        return view('pages.licenses.show', compact('user', 'workspace', 'license'));
    }

    public function revokeDevice($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $workspace = $user->workspaces()->first();
        $activation = LicenseActivation::whereHas('license', function ($query) use ($workspace) {
            $query->where('workspace_id', $workspace->id);
        })->where('id', $id)->firstOrFail();

        $license = $activation->license;
        $activation->delete();
        $license->decrement('activations_count');

        return back()->with('success', 'Device has been successfully revoked. The activation slot is now free.');
    }

    public function update(Request $request, $id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $workspace = $user->workspaces()->first();
        $license = $workspace->licenses()->findOrFail($id);

        $request->validate([
            'expires_at' => ['nullable', 'date', 'after:today'],
        ]);

        $license->update([
            'expires_at' => $request->expires_at,
        ]);

        return back()->with('success', 'License expiration data updated successfully.');
    }
}
