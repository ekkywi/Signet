<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Traits\Auditable;

class Workspace extends Model
{
    use HasUuids, Auditable;

    protected $fillable = [
        'user_id',
        'name',
        'subscription_plan_id',
        'api_usage_count',
        'status',
        'suspension_reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function apiKeys()
    {
        return $this->hasMany(ApiKey::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
    }

    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }
}
