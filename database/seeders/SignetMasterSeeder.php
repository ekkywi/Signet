<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\Hash;

class SignetMasterSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminRole = Role::firstOrCreate(
            ['slug' => 'super-admin'],
            [
                'name' => 'Super Admin',
                'description' => 'Full access to all resources and permissions.',
            ]
        );

        $tenantRole = Role::firstOrCreate(
            ['slug' => 'tenant'],
            [
                'name' => 'Tenant',
                'description' => 'Limited access to tenant-specific resources.',
            ]
        );

        $freePlan = SubscriptionPlan::firstOrCreate(
            ['slug' => 'free'],
            [
                'name' => 'Free',
                'price_monthly' => 0.00,
                'max_products' => 1,
                'max_licenses' => 10,
                'has_api_access' => false,
            ]
        );

        SubscriptionPlan::firstOrCreate(
            ['slug' => 'pro'],
            [
                'name' => 'Professional',
                'price_monthly' => 29.99,
                'max_products' => 5,
                'max_licenses' => 1000,
                'has_api_access' => true,
            ]
        );

        $admin = User::firstOrCreate(
            ['email' => 'admin@signet.local'],
            [
                'name' => 'Signet Administrator',
                'password' => Hash::make('AdminPassword!123'),
            ]
        );

        if (!$admin->hasVerifiedEmail()) {
            $admin->markEmailAsVerified();
        }

        if (!$admin->hasRole('super-admin')) {
            $admin->roles()->attach($superAdminRole->id);
        }

        $dummy = User::firstOrCreate(
            ['email' => 'dummy@signet.local'],
            [
                'name' => 'Dummy User',
                'password' => Hash::make('DummyPassword123!'),
                'email_verified_at' => now(),
            ]
        );

        if (!$dummy->hasVerifiedEmail()) {
            $dummy->markEmailAsVerified();
        }

        if (!$dummy->hasRole('tenant')) {
            $dummy->roles()->attach($tenantRole->id);
        }

        if ($dummy->workspaces()->count() === 0) {
            $dummy->workspaces()->create([
                'name' => 'Dummy Workspace',
                'subscription_plan_id' => $freePlan->id,
            ]);
        }
    }
}
