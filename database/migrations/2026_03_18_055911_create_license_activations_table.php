<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('license_activations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('license_id')->constrained()->cascadeOnDelete();
            $table->string('hardware_id');
            $table->string('device_name')->nullable();
            $table->timestamp('last_active_at')->useCurrent();
            $table->timestamps();
            $table->unique(['license_id', 'hardware_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('license_activations');
    }
};
