<?php

namespace Modules\Shared\Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['Owner' => 'owner', 'Admin' => 'admin', 'Manager' => 'manager', 'Staff' => 'staff', 'Viewer' => 'viewer', 'Custom' => 'custom', 'Portal User' => 'portal_user'];

        foreach ($roles as $role => $slug) {
            DB::table('permission_roles')->updateOrInsert(
                ['name' => $role, 'slug' => $slug, 'tenant_id' => 1],
                [
                    'guard' => 'api',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}