<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Traits\Auditable;

class LicenseActivation extends Model
{
    use HasUuids, Auditable;

    protected $fillable = [
        'license_id',
        'hardware_id',
        'device_name',
        'last_active_at'
    ];

    protected $casts = [
        'last_active_at' => 'datetime',
    ];

    public function license()
    {
        return $this->belongsTo(License::class);
    }
}
