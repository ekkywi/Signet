<?php

namespace App\Services\Admin\Hsm;

use App\Models\HsmNode;
use Illuminate\Support\Str;
use Exception;

class HsmNodeService
{
    public function registerNode(array $data): array
    {
        $secretKey = 'sk_hsm_' . Str::random(40);
        $enrollToken = 'hsm_enr_' . Str::random(20);
        $node = HsmNode::create([
            'name' => $data['name'],
            'host_path' => $data['host_path'],
            'secret_key' => $secretKey,
            'enrollment_token' => $enrollToken,
            'enrollment_expires_at' => now()->addMinutes(15),
            'status' => 'offline',
        ]);

        return [
            'node' => $node,
            'enrollment_token' => $enrollToken,
        ];
    }

    public function enrollNode(string $token): array
    {
        $node = HsmNode::where('enrollment_token', $token)->where('enrollment_expires_at', '>', now())->first();

        if (!$node) {
            throw new Exception('Invalid or expired enrollment token.');
        }

        $secretKey = $node->secret_key;
        $node->update([
            'enrollment_token' => null,
            'enrollment_expires_at' => null,
        ]);

        return [
            'secret_key' => $secretKey,
            'node_name' => $node->name,
        ];
    }

    public function update(HsmNode $node, array $data): HsmNode
    {
        $node->update([
            'name' => $data['name'],
            'host_path' => $data['host_path'],
            'is_primary' => isset($data['is_primary']),
        ]);

        return $node;
    }

    public function deleteNode(HsmNode $node): void
    {
        $originalName = $node->name;
        $mutatedName = $originalName . ' [RVK-' . now()->format('ymdHi') . ']';
        $node->update([
            'name' => $mutatedName,
            'status' => 'revoked',
            'is_primary' => false,
            'is_active' => false,
            'secret_key' => 'revoked_' . Str::random(40),
        ]);

        $node->delete();
    }

    public function processPing(HsmNode $node, ?int $temperature): void
    {
        $node->update([
            'status' => 'online',
            'last_ping_at' => now(),
            'temperature' => $temperature,
        ]);
    }
}
