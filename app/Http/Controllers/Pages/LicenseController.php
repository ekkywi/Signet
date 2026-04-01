<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\License\StoreLicenseRequest;
use App\Http\Requests\License\UpdateLicenseRequest;
use App\Services\Licenses\LicenseService;
use Illuminate\Support\Facades\Auth;

class LicenseController extends Controller
{
    protected LicenseService $licenseService;

    public function __construct(LicenseService $licenseService)
    {
        $this->licenseService = $licenseService;
    }

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $workspace = $user->workspaces()->first();
        $products = $workspace->products()->orderBy('name')->get();
        $licenses = $workspace->licenses()->with('product')->latest()->get();

        return view('pages.licenses.index', compact('user', 'workspace', 'products', 'licenses'));
    }

    public function store(StoreLicenseRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $workspace = $user->workspaces()->first();
        $license = $this->licenseService->createLicense($workspace, $request->validated());

        return back()->with('success', 'License key generated: ' . $license->key);
    }

    public function show($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $workspace = $user->workspaces()->first();
        $license = $workspace->licences()
            ->with(['product', 'activations' => function ($query) {
                $query->latest('last_active_at');
            }])
            ->findOrFail($id);

        return view('pages.licenses.show', compact('user', 'workspace', 'license'));
    }

    public function update(UpdateLicenseRequest $request, $id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $workspace = $user->workspaces()->first();

        $this->licenseService->updateLicense($workspace, $id, $request->validated());

        return back()->with('success', 'License expiration date updated successfully.');
    }

    public function destroy($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $workspace = $user->workspaces()->first();

        $this->licenseService->deleteLicense($workspace, $id);

        return back()->with('success', 'License revoked and deleted successfully.');
    }

    public function revokeDevice($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $workspace = $user->workspaces()->first();

        $this->licenseService->revokeDevice($workspace, $id);

        return back()->with('success', 'Device has been successfully revoked. The license can now be activated on another device.');
    }
}
