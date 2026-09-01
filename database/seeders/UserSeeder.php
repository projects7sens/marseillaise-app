<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::where('name', 'SuperAdmin')->firstOrFail();
        $admin = Role::where('name', 'Admin')->firstOrFail();
        $user = Role::where('name', 'User')->firstOrFail();

        User::withoutEvents(function () use ($superAdmin, $admin, $user) {
            User::factory()
                ->withRole($superAdmin)
                ->create([
                    'first_name' => 'Super',
                    'last_name' => 'Admin',
                    'email' => 'superadmin@lamarseillaise.sn',
                    'mobile_number' => '+221770000001',
                ]);

            User::factory()
                ->withRole($admin)
                ->count(3)
                ->create();

            User::factory()
                ->withRole($user)
                ->count(20)
                ->create();
        });
    }
}
