<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Assumption:
         * - permission_roles table already seeded
         * - permission_permissions table already seeded
         */

        // Role wise permission mapping (by slug)
        $rolePermissions = [
            'Super Admin' => ['*'], // all permissions
            'Admin' => [
                'user.view', 'user.create', 'user.update',
                'role.view', 'role.create', 'role.update',
            ],
            'Accountant' => [
                'fee.view', 'fee.collect', 'payment.view',
            ],
            'Teacher' => [
                'student.view', 'attendance.manage',
            ],
            'Student' => [
                'profile.view',
            ],
        ];

        foreach ($rolePermissions as $roleName => $permissionSlugs) {

            $role = DB::table('permission_roles')
                ->where('name', $roleName)
                ->first();

            if (!$role) {
                continue; // role not found → skip
            }

            // Super Admin → all permissions
            if (in_array('*', $permissionSlugs)) {
                $permissions = DB::table('permission_permissions')->get();
            } else {
                $permissions = DB::table('permission_permissions')
                    ->whereIn('slug', $permissionSlugs)
                    ->get();
            }

            foreach ($permissions as $permission) {
                DB::table('permission_role_permissions')->updateOrInsert(
                    [
                        'role_id' => $role->id,
                        'permission_id' => $permission->id,
                    ],
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}
