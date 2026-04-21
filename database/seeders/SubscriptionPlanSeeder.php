<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    public function run(): void
    {
        SubscriptionPlan::create([
            'name' => 'Starter Plan',
            'monthly_api_limit' => 10000,
            'max_products' => 1,
            'max_licenses' => 50,
        ]);

        SubscriptionPlan::create([
            'name' => 'Pro Plan',
            'monthly_api_limit' => 50000,
            'max_products' => 3,
            'max_licenses' => 200,
        ]);

        SubscriptionPlan::create([
            'name' => 'Enterprise Plan',
            'monthly_api_limit' => 9999999,
            'max_products' => 10,
            'max_licenses' => 1000,
        ]);
    }
}