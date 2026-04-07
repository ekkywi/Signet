<?php

namespace App\Listeners\Auth;

use App\Models\AuditLog;
use Illuminate\Auth\Events\Login;

class LogSuccessfulLogin
{
    public function handle(Login $event): void
    {
        $user = $event->user;
        $workspace = $user->workspaces()->first();

        AuditLog::create([
            'workspace_id' => $workspace?->id,
            'user_id' => $user->id,
            'action' => 'login',
            'auditable_type' => get_class($user),
            'auditable_id' => $user->id,
            'old_data' => null,
            'new_data' => [
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'login_at' => now()->toDateTimeString(),
            ]
        ]);
    }
}
