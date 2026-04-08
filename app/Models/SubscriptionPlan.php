<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SubscriptionPlan extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'slug',
        'price_monthly',
        'max_products',
        'max_licenses',
        'has_api_access',
    ];

    public function workspaces()
    {
        return $this->hasMany(Workspace::class);
    }
}
