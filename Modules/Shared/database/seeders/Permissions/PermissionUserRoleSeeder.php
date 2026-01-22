<?php

namespace Modules\Shared\Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionUserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $role = DB::table('permission_roles')->first();

        if (!$role) {
            throw new \Exception('No roles found. PermissionRoleSeeder did not run.');
        }

        DB::table('permission_user_roles')->insert([
            'user_id' => 1,
            'role_id' => $role->id,
        ]);
    }
}
