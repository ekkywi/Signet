<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Testing\Fluent\Concerns\Has;

class Product extends Model
{
    use HasUuids;

    protected $fillable = [
        'workspace_id',
        'name',
        'slug',
        'description',
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
