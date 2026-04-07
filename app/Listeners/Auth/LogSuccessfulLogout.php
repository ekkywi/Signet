<?php

namespace App\Listeners\Auth;

use App\Models\AuditLog;
use Illuminate\Auth\Events\Logout;

class LogSuccessfulLogout
{
    public function handle(Logout $event): void
    {
        $user = $event->user;
        $workspace = $user->workspaces()->first();

        AuditLog::create([
            'workspace_id' => $workspace?->id,
            'user_id' => $user->id,
            'action' => 'logout',
            'auditable_type' => get_class($user),
            'auditable_id' => $user->id,
            'old_data' => null,
            'new_data' => [
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'logout_at' => now()->toDateTimeString(),
            ]
        ]);
    }
}
    