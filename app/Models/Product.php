<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Traits\Auditable;

class Product extends Model
{
    use HasUuids, Auditable;

    protected $fillable = [
        'workspace_id',
        'name',
        'slug',
        'description',
        'wrapped_private_key',
        'iv',
        'auth_tag',
        'certificate',
    ];

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
    }
}
