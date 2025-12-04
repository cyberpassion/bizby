<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TenantUserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'tenant_id' => 1,
                'name' => 'John Admin',
                'email' => 'john@alphauni.edu',
                'phone' => '9876543210',
                'password' => Hash::make('password123'),
                'role' => 'superadmin',
                'is_active' => true,
                'meta' => json_encode(['department' => 'IT']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenant_id' => 2,
                'name' => 'Jane Principal',
                'email' => 'jane@betacollege.edu',
                'phone' => '9123456780',
                'password' => Hash::make('password123'),
                'role' => 'principal',
                'is_active' => true,
                'meta' => json_encode(['department' => 'Admin']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tenant_users')->insert($users);
    }
}