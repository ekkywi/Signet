<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ApiKey;

class VerifyApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken() ?? $request->header('x-api-key');

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized: API key is invalid or missing.'
            ], 401);
        }

        $apiKey = ApiKey::where('token', $token)->first();

        if (!$apiKey) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized: Invalid or revoked API key.'
            ], 401);
        }

        $apiKey->update(['last_used_at' => now()]);

        return $next($request);
    }
}
