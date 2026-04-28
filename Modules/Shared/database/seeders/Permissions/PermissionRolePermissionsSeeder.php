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

        foreach ($permissions as $slug => $pid) {

            // 🔥 OWNER → everything
            DB::table('permission_role_permissions')->updateOrInsert([
                'role_id' => $roles['Owner'],
                'permission_id' => $pid,
            ], [
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 🔥 ADMIN → everything except billing/core
            if (!str_contains($slug, 'plans') &&
                !str_contains($slug, 'subscriptions')) {

                DB::table('permission_role_permissions')->updateOrInsert([
                    'role_id' => $roles['Admin'],
                    'permission_id' => $pid,
                ], [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // 🔥 MANAGER → view + create + update
            if (preg_match('/\.(view|create|update)$/', $slug)) {

                DB::table('permission_role_permissions')->updateOrInsert([
                    'role_id' => $roles['Manager'],
                    'permission_id' => $pid,
                ], [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // 🔥 STAFF → view + create
            if (preg_match('/\.(view|create)$/', $slug)) {

                DB::table('permission_role_permissions')->updateOrInsert([
                    'role_id' => $roles['Staff'],
                    'permission_id' => $pid,
                ], [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // 🔥 VIEWER → only view
            if (str_ends_with($slug, '.view')) {

                DB::table('permission_role_permissions')->updateOrInsert([
                    'role_id' => $roles['Viewer'],
                    'permission_id' => $pid,
                ], [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // ❌ CUSTOM → no auto permissions
        }
    }
}