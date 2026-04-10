<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class HsmNode extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'connection_type',
        'host_path',
        'secret_key',
        'enrollment_token',
        'enrollment_expires_at',
        'is_primary',
        'is_active',
        'status',
        'temperature',
        'last_ping_at',
    ];

    protected $hidden = [
        'secret_key',
        'enrollment_token',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'is_active' => 'boolean',
        'last_ping_at' => 'datetime',
        'enrollement_expires_at' => 'datetime',
    ];
}
