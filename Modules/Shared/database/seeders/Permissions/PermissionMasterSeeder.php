<?php

namespace Modules\Shared\Database\Seeders\Permissions;
use Illuminate\Database\Seeder;

class PermissionMasterSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            \Modules\Shared\Database\Seeders\Permissions\PermissionPermissionsSeeder::class,
            \Modules\Shared\Database\Seeders\Permissions\PermissionRoleSeeder::class,
			\Modules\Shared\Database\Seeders\Permissions\PermissionRolePermissionsSeeder::class,
			\Modules\Shared\Database\Seeders\Permissions\PermissionUserPermissionSeeder::class,
			\Modules\Shared\Database\Seeders\Permissions\PermissionUserRoleSeeder::class
        ]);
    }
}