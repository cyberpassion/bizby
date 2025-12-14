<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Shared\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Student Module
            ['module' => 'student', 'operation' => 'create'],
            ['module' => 'student', 'operation' => 'view'],
            ['module' => 'student', 'operation' => 'update'],
            ['module' => 'student', 'operation' => 'delete'],

            // Fees Module
            ['module' => 'fees', 'operation' => 'collect'],
            ['module' => 'fees', 'operation' => 'refund'],

            // Reports Module
            ['module' => 'reports', 'operation' => 'view'],
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(
                [
                    'slug' => "{$perm['module']}.{$perm['operation']}"
                ],
                [
                    'module' => $perm['module'],
                    'operation' => $perm['operation'],
                ]
            );
        }
    }
}
