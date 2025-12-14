<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Shared\Models\PermissionRole;

class PermissionRoleSeeder extends Seeder
{
    public function run(): void
    {
        PermissionRole::firstOrCreate([
            'name' => 'Admin',
            'client_id' => 1,
        ]);

        PermissionRole::firstOrCreate([
            'name' => 'Accountant',
            'client_id' => 1,
        ]);

        PermissionRole::firstOrCreate([
            'name' => 'Teacher',
            'client_id' => 1,
        ]);
    }
}
