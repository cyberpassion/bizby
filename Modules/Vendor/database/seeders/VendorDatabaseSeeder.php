<?php

namespace Modules\Vendor\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Vendor\Database\Seeders\VendorSeeder;

class VendorDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            VendorSeeder::class
        ]);
    }
}
