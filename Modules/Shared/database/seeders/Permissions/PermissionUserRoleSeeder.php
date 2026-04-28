<?php

namespace Modules\Shared\Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionUserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $role = DB::table('permission_roles')
            ->where('name', 'Owner')
            ->first();

        DB::table('permission_user_roles')->updateOrInsert([
            'user_id' => 1,
            'role_id' => $role->id,
        ]);
    }
}