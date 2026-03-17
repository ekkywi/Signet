<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\License;

class LicenseController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $workspace = $user->workspaces()->first();
        $products = $workspace->products()->orderBy('name')->get();
        $licenses = $workspace->licenses()->with('product')->latest()->get();

        return view('pages.licenses.index', compact('user', 'workspace', 'products', 'licenses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'max_activations' => ['required', 'integer', 'min:1'],
        ]);

        $workspace = Auth::user()->workspaces()->first();

        $key =
            Str::upper(Str::random(4)) . '-' .
            Str::upper(Str::random(4)) . '-' .
            Str::upper(Str::random(4)) . '-' .
            Str::upper(Str::random(4));

        $workspace->licenses()->create([
            'product_id' => $request->product_id,
            'key' => $key,
            'status' => 'active',
            'require_hardware_lock' => $request->has('require_hardware_lock'),
            'max_activations' => $request->max_activations,
        ]);

        return back()->with('success', 'License key generated: ' . $key);
    }

    public function destroy($id)
    {
        $workspace = Auth::user()->workspaces()->first();
        $license = $workspace->licenses()->where('id', $id)->firstOrFail();
        $license->delete();

        return back()->with('success', 'License revoked and deleted.');
    }
}
