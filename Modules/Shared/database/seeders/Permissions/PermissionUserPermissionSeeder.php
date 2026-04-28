<?php

namespace Modules\Shared\Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionUserPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissionId = DB::table('permission_permissions')
            ->where('slug', 'employee.employees.create')
            ->value('id');

        if ($permissionId) {
            DB::table('permission_user_permissions')->updateOrInsert([
                'user_id' => 1,
                'permission_id' => $permissionId,
                'tenant_id' => 1,
            ], [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}