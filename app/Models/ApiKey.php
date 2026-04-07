<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Traits\Auditable;

class ApiKey extends Model
{
    use HasUuids, Auditable;

    protected $fillable = [
        'workspace_id',
        'name',
        'token',
        'last_chars',
        'last_used_at',
    ];

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }
}
