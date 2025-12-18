<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Super Admin', 'client_id' => 1],
            ['name' => 'Admin', 'client_id' => 1],
            ['name' => 'Accountant', 'client_id' => 1],
            ['name' => 'Teacher', 'client_id' => 1],
            ['name' => 'Student', 'client_id' => 1],
        ];

        foreach ($roles as $role) {
            DB::table('permission_roles')->updateOrInsert(
                [
                    'name' => $role['name'],
                    'client_id' => $role['client_id'],
                ],
                [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}

