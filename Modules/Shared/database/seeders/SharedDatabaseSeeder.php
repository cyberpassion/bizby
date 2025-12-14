<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Shared\Database\Seeders\TermSeeder;
use Modules\Shared\Database\Seeders\PermissionPermissionsSeeder;
use Modules\Shared\Database\Seeders\PermissionRoleSeeder;
use Modules\Shared\Database\Seeders\PermissionRolePermissionsSeeder;
use Modules\Shared\Database\Seeders\OnlinePaymentsSeeder;
use Modules\Shared\Database\Seeders\OptionsSeeder;
use Modules\Shared\Database\Seeders\activityLogsSeeder;

class SharedDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            TermSeeder::class,
			PermissionPermissionsSeeder::class,
			PermissionRoleSeeder::class,
			PermissionRolePermissionsSeeder::class,
            OnlinePaymentsSeeder::class,
            OptionsSeeder::class,
            activityLogsSeeder::class
        ]);
    }
}
