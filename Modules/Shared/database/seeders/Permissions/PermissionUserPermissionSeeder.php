<?php

namespace Modules\Shared\Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionUserPermissionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('permission_user_permissions')->insert([
            'user_id' => 1,
            'permission_id' => DB::table('permission_permissions')
                ->where('slug', 'users.delete')
                ->value('id'),
            'tenant_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
