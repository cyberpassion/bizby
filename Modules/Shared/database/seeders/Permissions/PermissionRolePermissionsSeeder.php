<?php

namespace Modules\Shared\Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRolePermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $roles = DB::table('permission_roles')->pluck('id', 'name');
        $permissions = DB::table('permission_permissions')->pluck('id', 'slug');

        foreach ($permissions as $pid) {
            DB::table('permission_role_permissions')->insert([
                'role_id' => $roles['Owner'],
                'permission_id' => $pid,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        foreach ($permissions as $slug => $pid) {
            if (!str_contains($slug, 'plans')) {
                DB::table('permission_role_permissions')->insert([
                    'role_id' => $roles['Admin'],
                    'permission_id' => $pid,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        foreach ($permissions as $slug => $pid) {
            if (str_ends_with($slug, '.view')) {
                DB::table('permission_role_permissions')->insert([
                    'role_id' => $roles['Staff'],
                    'permission_id' => $pid,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
