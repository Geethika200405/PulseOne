<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['role_name' => 'Admin'],
            ['role_name' => 'Trainer'],
            ['role_name' => 'Dietitian'],
            ['role_name' => 'Member'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['role_name' => $role['role_name']], // match on name
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
