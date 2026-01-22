<?php

namespace Modules\Shared\Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            'users' => ['view','create','update','delete','export'],
            'roles' => ['view','create','update','delete'],
            'permissions' => ['view','create','update','delete'],
            'orders' => ['view','create','update','delete','export','approve'],
            'invoices' => ['view','create','update','delete','approve','export'],
            'payments' => ['view','refund'],
            'products' => ['view','create','update','delete'],
            'customers' => ['view','create','update','delete'],
            'reports' => ['view','export'],
            'settings' => ['view','update'],
            'audit_logs' => ['view'],
            'plans' => ['view','update'],
            'subscriptions' => ['view','update','cancel'],
        ];

        foreach ($modules as $module => $operations) {

            // Parent: module.*
            $parentId = DB::table('permission_permissions')->insertGetId([
                'module' => $module,
                'operation' => '*',
                'slug' => "$module.*",
                'scope' => 'global',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($operations as $op) {
                DB::table('permission_permissions')->insert([
                    'module' => $module,
                    'operation' => $op,
                    'slug' => "$module.$op",
                    'parent_id' => $parentId,
                    'scope' => 'global',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
