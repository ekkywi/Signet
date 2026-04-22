<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    public function run(): void
    {
        SubscriptionPlan::updateOrCreate(
            ['slug' => 'free'],
            [
                'name' => 'Free',
                'monthly_api_limit' => 1000,
                'max_products' => 1,
                'max_licenses' => 10,
                'price_monthly' => 0.00,
                'has_api_access' => true,
            ]
        );

        SubscriptionPlan::updateOrCreate(
            ['slug' => 'pro'],
            [
                'name' => 'Pro',
                'monthly_api_limit' => 10000,
                'max_products' => 10,
                'max_licenses' => 100,
                'price_monthly' => 29.99,
                'has_api_access' => true,
            ]
        );

        SubscriptionPlan::updateOrCreate(
            ['slug' => 'pro-plus'],
            [
                'name' => 'Pro+',
                'monthly_api_limit' => 9999999,
                'max_products' => 10,
                'max_licenses' => 1000,
                'price_monthly' => 99.99,
                'has_api_access' => true,
            ]
        );
    }
}
