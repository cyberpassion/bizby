<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = DB::table('permission_roles')->pluck('id', 'name');
        $permissions = DB::table('permission_permissions')->pluck('id', 'slug');

        // Owner = everything
        foreach ($permissions as $pid) {
            DB::table('permission_role_permissions')->insert([
                'role_id' => $roles['Owner'],
                'permission_id' => $pid,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Admin = most things
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

        // Staff = limited
        foreach ($permissions as $slug => $pid) {
            if (str_contains($slug, '.view')) {
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
