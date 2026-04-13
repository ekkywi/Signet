<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HsmCommand extends Model
{
    protected $fillable = [
        'hsm_node_id',
        'command',
        'status',
        'response',
    ];

    public function hsmNode()
    {
        return $this->belongsTo(HsmNode::class);
    }
}
