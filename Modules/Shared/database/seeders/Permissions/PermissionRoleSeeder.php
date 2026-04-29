<?php

namespace Modules\Shared\Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Owner',
                'slug' => 'owner',
                'type' => 'module',
            ],
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'type' => 'module',
            ],
            [
                'name' => 'Manager',
                'slug' => 'manager',
                'type' => 'module',
            ],
            [
                'name' => 'Staff',
                'slug' => 'staff',
                'type' => 'module',
            ],
            [
                'name' => 'Viewer',
                'slug' => 'viewer',
                'type' => 'module',
            ],
            [
                'name' => 'Custom',
                'slug' => 'custom',
                'type' => 'module',
            ],
            [
                'name' => 'Portal User',
                'slug' => 'portal_user',
                'type' => 'module',
            ],
            [
                'name' => 'Admin Incident User',
                'slug' => 'admin_incident_user',
                'type' => 'module',
                'meta' => [
                    'modules' => ['incident'],
                    'extra_modules' => ['note'],
                ],
            ],
            [
                'name' => 'Portal Registration User',
                'slug' => 'portal_registration_user',
                'type' => 'module',
            ],
        ];

        foreach ($roles as $role) {

            DB::table('permission_roles')->updateOrInsert(
                [
                    'name' => $role['name'],
                    'tenant_id' => 1,
                ],
                [
                    'slug' => $role['slug'],
                    'type' => $role['type'] ?? 'module', // 🔥 added
                    'guard' => 'api',
                    'meta' => isset($role['meta']) ? json_encode($role['meta']) : null,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}