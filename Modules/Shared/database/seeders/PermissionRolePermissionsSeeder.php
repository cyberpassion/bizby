<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Shared\Models\PermissionRole;
use Modules\Shared\Models\Permission;

class PermissionRolePermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $admin = PermissionRole::where('name', 'Admin')->where('client_id', 1)->first();
        $accountant = PermissionRole::where('name', 'Accountant')->where('client_id', 1)->first();
        $teacher = PermissionRole::where('name', 'Teacher')->where('client_id', 1)->first();

        // Admin → all permissions
        $admin->permissions()->sync(Permission::pluck('id'));

        // Accountant permissions
        $accountant->permissions()->sync(
            Permission::whereIn('slug', [
                'fees.collect',
                'fees.refund',
                'reports.view',
                'student.view',
            ])->pluck('id')
        );

        // Teacher permissions
        $teacher->permissions()->sync(
            Permission::whereIn('slug', [
                'student.view',
                'student.update',
                'reports.view',
            ])->pluck('id')
        );
    }
}
