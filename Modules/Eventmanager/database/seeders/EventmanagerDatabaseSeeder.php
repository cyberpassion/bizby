<?php

namespace Modules\Eventmanager\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Eventmanager\Database\Seeders\EventmanagerSeeder;

class EventmanagerDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            EventmanagerSeeder::class,
        ]);
    }
}
