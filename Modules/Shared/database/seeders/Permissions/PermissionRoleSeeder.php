<?php

namespace Modules\Shared\Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [

            /**
             * =================================================
             * PLATFORM / SYSTEM ROLES
             * =================================================
             */
            [
                'name' => 'Super Admin',

                'slug' => 'super_admin',

                'surface' => 'admin',

                'description' => 'Platform-wide unrestricted access',

                'priority' => 100,

                'is_system' => true,
            ],

            /**
             * =================================================
             * ADMIN ROLES
             * =================================================
             */
            [
                'name' => 'Owner',

                'slug' => 'owner',

                'surface' => 'admin',

                'description' => 'Full unrestricted tenant access',

                'priority' => 90,

                'is_system' => true,
            ],

            [
                'name' => 'Admin',

                'slug' => 'admin',

                'surface' => 'admin',

                'description' => 'Administrative access',

                'priority' => 80,

                'is_system' => true,
            ],

            [
                'name' => 'Support Agent',

                'slug' => 'support_agent',

                'surface' => 'admin',

                'description' => 'Customer support and troubleshooting access',

                'priority' => 75,

                'is_system' => true,
            ],

            [
                'name' => 'Auditor',

                'slug' => 'auditor',

                'surface' => 'admin',

                'description' => 'Audit and compliance access',

                'priority' => 70,

                'is_system' => true,
            ],

            [
                'name' => 'Manager',

                'slug' => 'manager',

                'surface' => 'admin',

                'description' => 'Manager level access',

                'priority' => 60,

                'is_system' => true,
            ],

            [
                'name' => 'Staff',

                'slug' => 'staff',

                'surface' => 'admin',

                'description' => 'Staff access',

                'priority' => 40,

                'is_system' => true,
            ],

            [
                'name' => 'Viewer',

                'slug' => 'viewer',

                'surface' => 'admin',

                'description' => 'Read only access',

                'priority' => 10,

                'is_system' => true,
            ],

            [
                'name' => 'Custom',

                'slug' => 'custom',

                'surface' => 'admin',

                'description' => 'Custom configurable role',

                'priority' => 5,

                'is_system' => true,
            ],

            /**
             * =================================================
             * PORTAL ROLES
             * =================================================
             */
            [
                'name' => 'Portal User',

                'slug' => 'portal_user',

                'surface' => 'portal',

                'description' => 'Basic portal access',

                'priority' => 50,

                'is_system' => true,
            ],

            [
                'name' => 'Portal Registration User',

                'slug' => 'portal_registration_user',

                'surface' => 'portal',

                'description' => 'Portal registration access',

                'priority' => 40,

                'is_system' => true,

                'meta' => [

                    'access' => [

                        'resources' => [
                            'registration',
                        ],

                        'addons' => [],

                        'features' => [],
                    ],
                ],
            ],

            /**
             * =================================================
             * RESOURCE-SPECIFIC ROLES
             * =================================================
             */
            [
                'name' => 'Admin Incident User',

                'slug' => 'admin_incident_user',

                'surface' => 'admin',

                'description' => 'Incident management access',

                'priority' => 50,

                'is_system' => true,

                'meta' => [

                    'access' => [

                        'resources' => [
                            'incident',
                        ],

                        'addons' => [],

                        'features' => [
                            'note',
                        ],
                    ],
                ],
            ],

            /**
             * =================================================
             * API / INTEGRATION ROLES
             * =================================================
             */
            [
                'name' => 'API Client',

                'slug' => 'api_client',

                'surface' => 'api',

                'description' => 'API integration access',

                'priority' => 30,

                'is_system' => true,
            ],
        ];

        foreach ($roles as $role) {

            DB::table('permission_roles')
                ->updateOrInsert(
                    [
                        'slug' => $role['slug'],
                    ],
                    [
                        'name' => $role['name'],

                        'description' => $role['description'] ?? null,

                        'surface' => $role['surface'],

                        'guard' => 'api',

                        'priority' => $role['priority'] ?? 0,

                        'meta' => isset($role['meta'])
                            ? json_encode($role['meta'])
                            : null,

                        'is_system' => $role['is_system'] ?? false,

                        'updated_at' => now(),

                        'created_at' => now(),
                    ]
                );
        }
    }
}
