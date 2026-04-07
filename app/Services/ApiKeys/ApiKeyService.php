<?php

namespace App\Services\ApiKeys;

use App\Models\Workspace;
use Illuminate\Support\Str;
use App\Models\ApiKey;

class ApiKeyService
{
    public function createApiKey(Workspace $workspace, array $data)
    {
        $rawToken = 'sgnt_live_' . Str::random(40);
        $hashedToken = hash('sha256', $rawToken);
        $lastChars = substr($rawToken, -4);
        $workspace->apiKeys()->create([
            'name'       => $data['name'],
            'token'      => $hashedToken,
            'last_chars' => $lastChars,
        ]);

        return $rawToken;
    }

    public function deleteApiKey(Workspace $workspace, int|string $keyId): void
    {
        $apiKey = $workspace->apiKeys()->where('id', $keyId)->firstOrFail();
        $apiKey->delete();
    }
}
