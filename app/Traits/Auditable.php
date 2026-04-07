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
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        $oldData = $action !== 'created' ? $model->getOriginal() : null;
        $newData = $action !== 'deleted' ? $model->getAttributes() : null;

        AuditLog::create([
            'workspace_id' => $model->workspace_id ?? ($user ? $user->workspaces()->first()->id : null),
            'user_id' => $user ? $user->id : null,
            'action' => $action,
            'auditable_type' => get_class($model),
            'auditable_id' => $model->id,
            'old_data' => self::markSensitiveData($oldData),
            'new_data' => self::markSensitiveData($newData),
        ]);
    }
}
