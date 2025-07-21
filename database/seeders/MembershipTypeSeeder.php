<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['type_name' => 'Day', 'duration' => 1, 'price' => 500.00],
            ['type_name' => 'Month', 'duration' => 30, 'price' => 3000.00],
            ['type_name' => 'Three Months', 'duration' => 90, 'price' => 8250.00],
            ['type_name' => 'Six Months', 'duration' => 180, 'price' => 15000.00],
            ['type_name' => 'Annual', 'duration' => 365, 'price' => 24000.00],
        ];

        foreach ($types as $type) {
            DB::table('membership_types')->updateOrInsert(
                ['type_name' => $type['type_name']], // match by name
                array_merge($type, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }
}
