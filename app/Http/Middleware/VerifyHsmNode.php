<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\HsmNode;
use Symfony\Component\HttpFoundation\Response;

class VerifyHsmNode
{
    public function handle(Request $request, Closure $next): Response
    {
        $secretKey = $request->bearerToken();

        if (!$secretKey) {
            return response()->json(['error' => 'Missing HSM Secret Key'], 401);
        }

        $node = HsmNode::where('secret_key', $secretKey)->where('status', '!=', 'revoked')->first();

        if (!$node) {
            return response()->json(['error' => 'Invalid or Revoked HSM Secret Key'], 403);
        }

        $request->attributes->add(['hsm_node' => $node]);

        return $next($request);
    }
}
