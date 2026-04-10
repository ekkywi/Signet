<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hsm_nodes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->string('host_path');
            $table->string('secret_key')->unique();
            $table->string('enrollment_token')->nullable()->unique();
            $table->timestamp('enrollment_expires_at')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('status')->default('offline');
            $table->integer('temperature')->nullable();
            $table->timestamp('last_ping_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hsm_nodes');
    }
};
