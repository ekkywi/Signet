<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $workspace = $user->workspaces()->first();
        $products = Product::where('workspace_id', $workspace->id)->withCount('licenses')->get();

        return view('pages.products.index', compact('user', 'workspace', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $workspace = Auth::user()->workspaces()->first();

        $config = [
            'private_key_bits' => 2048,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ];

        $keyPair = openssl_pkey_new($config);

        openssl_pkey_export($keyPair, $privateKeyPem);

        $dn = [
            'countryName' => 'ID',
            'organizationName' => "Signet Cloud KMS",
            'commonName' => $request->name . " License Authority",
        ];

        $csr = openssl_csr_new($dn, $privateKeyPem, $config);
        $x509Cert = openssl_csr_sign($csr, null, $privateKeyPem, 3650, $config);
        openssl_x509_export($x509Cert, $certificatePem);

        $encrptedPrivateKey = Crypt::encryptString($privateKeyPem);

        $workspace->products()->create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
            'description' => $request->description,
            'private_key' => $encrptedPrivateKey,
            'certificate' => $certificatePem,
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

    public function downloadCert($id)
    {
        $workspace = Auth::user()->workspaces()->first();
        $product = $workspace->products()->where('id', $id)->firstOrFail();

        if (empty($product->certificate)) {
            return back()->with('error', 'Certificate has not been generated for this product yet.');
        }

        $fileName = $product->slug . '-public.cert';

        return response($product->certificate, 200, [
            'Content-Type' => 'application/x-x509-ca-cert',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }
}
