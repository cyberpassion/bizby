<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;

// Existing Admin seeders
use Modules\Admin\Database\Seeders\InstallationSeeder;
use Modules\Admin\Database\Seeders\TenantSeeder;
use Modules\Admin\Database\Seeders\TenantModulesSeeder;
use Modules\Admin\Database\Seeders\TenantUserSeeder;

class AdminDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            // Admin module seeders
            TenantSeeder::class,
			InstallationSeeder::class,
            TenantModulesSeeder::class,
            TenantUserSeeder::class
        ]);
    }
}
