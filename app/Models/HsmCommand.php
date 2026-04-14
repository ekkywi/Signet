<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class HsmCommand extends Model
{
    use HasUuids;

    protected $fillable = [
        'hsm_node_id',
        'command',
        'status',
    ];

    public function node()
    {
        return $this->belongsTo(HsmNode::class, 'hsm_node_id');
    }
}
