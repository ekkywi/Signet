<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\HsmNode;

class SignLicenseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $clientData;

    public function __construct(array $clientData)
    {
        $this->clientData = $clientData;
    }

    public function handle(): void
    {
        $node = HsmNode::where('status', 'online')->first();

        if (!$node) {
            Log::warning('Hold Queue: No online HSM nodes available.');
            $this->release(10);
            return;
        }

        $node->update(['status' => 'busy']);
        Log::info("Starting license signing for {$this->clientData['app_name']} on node {$node->name}");

        try {
            sleep(3);
            $node->update(['status' => 'online']);
            Log::info("License signing completed for {$this->clientData['app_name']} on node {$node->name}");
        } catch (\Exception $e) {
            $node->update(['status' => 'online']);
            Log::error("Failed to sign license for {$this->clientData['app_name']} on node {$node->name}: {$e->getMessage()}");
            throw $e;
        }
    }
}
