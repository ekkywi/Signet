<?php

namespace App\Listeners\Auth;

use App\Models\AuditLog;
use Illuminate\Auth\Events\Logout;

class LogSuccessfulLogout
{
    public function handle(Logout $event): void
    {
        if (session()->has('impersonate_admin_id')) {
            return;
        }

        /** @var \App\Models\User $user */
        $user = $event->user;
        $workspace = $user->workspaces()->first();

        $isSuperAdmin = false;
        if (method_exists($user, 'hasRole')) {
            $isSuperAdmin = $user->hasRole('super-admin') || $user->hasRole('super_admin');
        } elseif (method_exists($user, 'roles')) {
            $isSuperAdmin = $user->roles()->whereIn('name', ['super-admin', 'super_admin'])->exists();
        }
        AuditLog::create([
            'workspace_id' => $workspace?->id,
            'user_id' => $user->id,
            'action' => 'logout',
            'is_system_action' => $isSuperAdmin,
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
