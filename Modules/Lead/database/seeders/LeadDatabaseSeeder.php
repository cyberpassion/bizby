<?php

namespace Modules\Lead\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Lead\Database\Seeders\LeadSeeder;

class LeadDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            LeadSeeder::class
        ]);
    }
}
