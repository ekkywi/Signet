<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ApiKey extends Model
{
    use HasUuids;

    protected $fillable = [
        'workspace_id',
        'name',
        'token',
        'last_used_at',
    ];

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }
}
