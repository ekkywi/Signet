<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $workspace = $user->workspaces()->first();
        $products = $workspace->products()->latest()->get();

        return view('pages.products.index', compact('user', 'workspace', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $workspace = Auth::user()->workspaces()->first();

        $workspace->products()->create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
            'description' => $request->description,
        ]);

        return back()->with('success', 'Product added successfully.');
    }

    public function destroy($id)
    {
        $workspace = Auth::user()->workspaces()->first();
        $product = $workspace->products()->where('id', $id)->firstOrFail();
        $product->delete();

        return back()->with('success', 'Product deleted successfully.');
    }
}
