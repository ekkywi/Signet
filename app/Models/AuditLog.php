<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Casts\Attribute;

class AuditLog extends Model
{
    use HasUuids;

    protected $guarded = [];

    protected $casts = [
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

                if ($this->old_data) {
                    return $this->old_data['name'] ?? $this->old_data['key'] ?? null;
                }

                if ($this->action === 'login' || $this->action === 'logout') {
                    $user = \App\Models\User::find($this->auditable_id);
                    return $user ? $user->name : 'Unknown User';
                }

                return 'Unknown';
            }
        );
    }
}
