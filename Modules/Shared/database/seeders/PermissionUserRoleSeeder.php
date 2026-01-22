<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionUserRoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user_roles')->insert([
            'user_id' => 1,
            'role_id' => DB::table('permission_roles')->where('name', 'Owner')->value('id')
        ]);
    }
}
