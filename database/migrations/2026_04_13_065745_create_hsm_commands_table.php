<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hsm_commands', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('hsm_node_id')->constrained()->onDelete('cascade');
            $table->string('command');
            $table->enum('status', ['pending', 'sent', 'executed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hsm_commands');
    }
};
