<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PermissionPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Avoid duplicate entries
        $permissions = [
            ['module' => 'Student', 'operation' => 'Create', 'slug' => 'student_create'],
            ['module' => 'Student', 'operation' => 'Read', 'slug' => 'student_read'],
            ['module' => 'Student', 'operation' => 'Update', 'slug' => 'student_update'],
            ['module' => 'Student', 'operation' => 'Delete', 'slug' => 'student_delete'],

            ['module' => 'OnlinePayments', 'operation' => 'Create', 'slug' => 'onlinepayments_create'],
            ['module' => 'OnlinePayments', 'operation' => 'Read', 'slug' => 'onlinepayments_read'],
            ['module' => 'OnlinePayments', 'operation' => 'Update', 'slug' => 'onlinepayments_update'],
            ['module' => 'OnlinePayments', 'operation' => 'Delete', 'slug' => 'onlinepayments_delete'],

            ['module' => 'Terms', 'operation' => 'Manage', 'slug' => 'terms_manage'],
            ['module' => 'ActivityLogs', 'operation' => 'View', 'slug' => 'activitylogs_view'],
            ['module' => 'Options', 'operation' => 'Manage', 'slug' => 'options_manage'],
        ];

        foreach ($permissions as $perm) {
            // Insert only if slug does not exist
            DB::table('permission_permissions')->updateOrInsert(
                ['slug' => $perm['slug']],
                [
                    'module' => $perm['module'],
                    'operation' => $perm['operation'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
