<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->bigInteger('monthly_api_limit')->default(100);
            $table->integer('max_products')->default(5);
            $table->integer('max_licenses')->default(50);
            $table->string('slug')->unique();
            $table->decimal('price_monthly', 10, 2)->default(0.00);
            $table->boolean('has_api_access')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};
