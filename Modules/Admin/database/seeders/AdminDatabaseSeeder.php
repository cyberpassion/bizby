<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;

// Existing Admin seeders
use Modules\Admin\Database\Seeders\Modules\ModuleSeeder;
use Modules\Admin\Database\Seeders\Addons\AddonSeeder;

// Developer seeders
//use Modules\Admin\Database\Seeders\Developer\TenantSeeder;
//use Modules\Admin\Database\Seeders\Developer\TenantModulesSeeder;
//use Modules\Admin\Database\Seeders\Developer\TenantUserSeeder;
use Modules\Admin\Database\Seeders\Developer\InstallationSeeder;

class AdminDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            // Admin module seeders
            //TenantSeeder::class,
			//InstallationSeeder::class,
            //TenantModulesSeeder::class,
            //TenantUserSeeder::class,
			ModuleSeeder::class,
			AddonSeeder::class,
        ]);
    }
}
