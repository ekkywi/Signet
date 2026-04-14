<?php

namespace App\Http\Controllers\Api\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\Hsm\HsmNodeService;

class HsmPingController extends Controller
{
    public function __construct(
        protected HsmNodeService $hsmNodeService,
    ) {}

    public function ping(Request $request)
    {
        $request->validate([
            'temperature' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ]);

        $node = $request->attributes->get('hsm_node');

        $this->hsmNodeService->processPing($node, $request->temperature);

        $pendingCommand = $node->commands()->where('status', 'pending')->oldest()->first();

        $responseData = [
            'status' => 'success',
            'message' => 'Pong',
            'server_time' => now()->toIso8601String(),
        ];

        if ($pendingCommand) {
            $responseData['action'] = $pendingCommand->command;
            $responseData['command_id'] = $pendingCommand->id;

            $pendingCommand->update([
                'status' => 'sent'
            ]);
        }

        return response()->json($responseData, 200);
    }
}
