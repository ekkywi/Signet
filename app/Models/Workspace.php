<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Workspace extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'name',
        'api_key'
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
}
