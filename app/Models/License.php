<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class License extends Model
{
    use HasUuids;

    protected $fillable = [
        'workspace_id',
        'product_id',
        'key',
        'status',
        'require_hardware_lock',
        'hardware_id',
        'activations_count',
        'max_activations',
        'expires_at',
    ];

    protected $casts = [
        'require_hardware_lock' => 'boolean',
        'expires_at' => 'datetime',
    ];

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function activations()
    {
        return $this->hasMany(LicenseActivation::class);
    }
}
