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
            ['name' => 'Super Admin', 'tenant_id' => 1],
            ['name' => 'Admin', 'tenant_id' => 1],
            ['name' => 'Accountant', 'tenant_id' => 1],
            ['name' => 'Teacher', 'tenant_id' => 1],
            ['name' => 'Student', 'tenant_id' => 1],
        ];

        foreach ($roles as $role) {
            DB::table('permission_roles')->updateOrInsert(
                [
                    'name' => $role['name'],
                    'tenant_id' => $role['tenant_id'],
                ],
                [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}

