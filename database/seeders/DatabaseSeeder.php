<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Prevent duplicate test user insertion
        if (!User::where('email', 'test@example.com')->exists()) {
            User::create([
                'first_name'     => 'Test',
                'last_name'      => 'User',
                'email'          => 'test@example.com',
                'password'       => Hash::make('password'),
                'dob'            => '2000-01-01',
                'mobile_number'  => '0770000000',
                'address'        => '123 Test St',
                'is_active'      => true,
                'mfa_enabled'    => false,
                'total_points'   => 0,
            ]);
        }

        // Call membership type seeder
        $this->call([
            MembershipTypeSeeder::class,
            RoleSeeder::class,
        ]);

    }
}
