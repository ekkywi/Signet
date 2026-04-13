<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HsmNode;

class SweepOfflineNodes extends Command
{
    protected $signature = 'hsm:sweep-offline';
    protected $description = 'Sweeping offline HSM nodes that have been offline for more than 30 seconds';

    public function handle()
    {
        $this->info('Starts Ghost Nodes scan... ');

        $threshold = now()->subSeconds(30);
        $updated = HsmNode::where('status', 'online')->where('status', 'online')->where(function ($query) use ($threshold) {
            $query->where('last_ping_at', '<', $threshold)->orWhereNull('last_ping_at');
        })->update(['status' => 'offline']);

        if ($updated > 0) {
            $this->info("Successfully updated $updated node(s) to offline status.");
        } else {
            $this->info("All nodes are healthy. No offline nodes found.");
        }
    }
}
