<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Casts\Attribute;

class AuditLog extends Model
{
    use HasUuids;

    protected $fillable = [
        'workspace_id',
        'user_id',
        'is_system_action',
        'action',
        'auditable_type',
        'auditable_id',
        'old_data',
        'new_data',
    ];

    protected $guarded = [];

    protected $casts = [
        'is_system_action' => 'boolean',
        'old_data' => 'array',
        'new_data' => 'array',
    ];

    public function auditable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function targetName(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->auditable) {
                    return $this->auditable->name ?? $this->auditable->key ?? null;
                }

                if ($this->new_data) {
                    return $this->new_data['name'] ?? $this->new_data['key'] ?? null;
                }

                if ($this->old_data) {
                    return $this->old_data['name'] ?? $this->old_data['key'] ?? null;
                }

                if ($this->action === 'login' || $this->action === 'logout') {
                    return $this->user ? $this->user->name : 'Unknown User';
                }

                return 'Unknown';
            }
        );
    }
}
