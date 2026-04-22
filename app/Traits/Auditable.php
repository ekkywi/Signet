<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

trait Auditable
{
    public static function bootAuditable()
    {
        static::created(function ($model) {
            self::logAction($model, 'created');
        });

        static::updated(function ($model) {
            self::logAction($model, 'updated');
        });

        static::deleted(function ($model) {
            self::logAction($model, 'deleted');
        });
    }

    public static function markSensitiveData(?array $data)
    {
        if (!$data) return null;

        $sensitiveFields = [
            'token',
            'wrapped_private_key',
            'password',
            'remember_token',
            'certificate',
        ];

        foreach ($sensitiveFields as $field) {
            if (array_key_exists($field, $data)) {
                $data[$field] = '******** [REDACTED SECURELY] ********';
            }
        }
        return $data;
    }

    public static function logAction($model, string $action)
    {
        if (!$model) return;

        /** @var \App\Models\User|null */
        $user = Auth::user();

        $oldData = $action !== 'created' ? $model->getOriginal() : null;
        $newData = $action !== 'deleted' ? $model->getAttributes() : null;

        $workspaceId = null;

        if (!empty($model->workspace_id)) {
            $workspaceId = $model->workspace_id;
        } elseif (class_basename($model) === 'Workspace') {
            if (isset($model->id)) {
                $workspaceId = $model->id;
            }
        } elseif ($user && method_exists($user, 'workspaces')) {
            $firstWorkspace = $user->workspaces()->first();
            if ($firstWorkspace && isset($firstWorkspace->id)) {
                $workspaceId = $firstWorkspace->id;
            }
        }

        $isSystemAction = false;

        if ($user) {
            if (method_exists($user, 'hasRole')) {
                $isSystemAction = $user->hasRole('super-admin') || $user->hasRole('super_admin');
            } elseif (method_exists($user, 'roles')) {
                $isSystemAction = $user->roles()->whereIn('name', ['super-admin', 'super_admin'])->exists();
            }
        }

        $userId = $user && isset($user->id) ? $user->id : null;
        $auditableId = isset($model->id) ? $model->id : null;

        AuditLog::create([
            'workspace_id'      => $workspaceId,
            'user_id'           => $userId,
            'is_system_action'  => $isSystemAction,
            'action'            => $action,
            'auditable_type'    => get_class($model),
            'auditable_id'      => $auditableId,
            'old_data'          => self::markSensitiveData($oldData),
            'new_data'          => self::markSensitiveData($newData),
        ]);
    }
}
