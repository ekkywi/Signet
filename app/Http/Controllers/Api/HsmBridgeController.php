<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EnrollHsmNodeRequest;
use App\Services\Admin\Hsm\HsmNodeService;
use Exception;

class HsmBridgeController extends Controller
{
    public function __construct(
        protected HsmNodeService $hsmNodeService
    ) {}

    public function enroll(EnrollHsmNodeRequest $request)
    {
        try {
            $result = $this->hsmNodeService->enrollNode($request->validated()['token']);
            return response()->json([
                'message' => 'Enrollment successful.',
                'secret_key' => $result['secret_key'],
                'node_name' => $result['node_name']
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }
}
