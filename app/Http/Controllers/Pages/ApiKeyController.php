<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiKeys\StoreApiKeyRequest;
use App\Services\ApiKeys\ApiKeyService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ApiKeyController extends Controller
{
    protected $apiKeyService;

    public function __construct(ApiKeyService $apiKeyService)
    {
        $this->apiKeyService = $apiKeyService;
    }

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $workspace = $user->workspaces()->first();
        $apiKeys = $workspace->apiKeys()->latest()->get();

        return view('pages.apikeys.index', compact('user', 'workspace', 'apiKeys'));
    }

    public function store(StoreApiKeyRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $workspace = $user->workspaces()->first();

        $rawToken = $this->apiKeyService->createApiKey($workspace, $request->validated());

        return back()
            ->with('success', 'New API key generated successfully.')
            ->with('new_api_key', $rawToken);
    }

    public function destroy($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $workspace = $user->workspaces()->first();

        $this->apiKeyService->deleteApiKey($workspace, $id);

        return back()->with('success', 'API Key revoked successfully.');
    }
}
