<?php

namespace Modules\Shared\Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'Owner'                 => 'owner',
            'Admin'                 => 'admin',
            'Manager'               => 'manager',
            'Staff'                 => 'staff',
            'Viewer'                => 'viewer',
            'Custom'                => 'custom',
            'Portal User'           => 'portal_user',
            'Admin Incident User'   => 'admin_incident_user',
            'Portal Registration User' => 'portal_registration_user'
        ];

        foreach ($roles as $name => $slug) {
            DB::table('permission_roles')->updateOrInsert(
                [
                    'name' => $name,
                    'tenant_id' => 1,
                ],
                [
                    'slug' => $slug,
                    'guard' => 'api',
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}