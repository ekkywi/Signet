<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Traits\Auditable;

class License extends Model
{
    use HasUuids, Auditable;

    protected $fillable = [
        'workspace_id',
        'product_id',
        'key',
        'status',
        'require_hardware_lock',
        'max_activations',
        'expires_at',
        'signature',
        'signed_payload',
    ];

    protected $casts = [
        'require_hardware_lock' => 'boolean',
        'expires_at' => 'datetime',
    ];

    protected function activationsCount(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (array_key_exists('activations_count', $this->attributes)) {
                    return (int) $this->attributes['activations_count'];
                }
                if ($this->relationLoaded('activations')) {
                    return $this->activations->count();
                }
                return 0;
            }
        );
    }

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
