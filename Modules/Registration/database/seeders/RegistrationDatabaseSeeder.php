<?php

namespace Modules\Registration\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Registration\Database\Seeders\RegistrationSeeder;

class RegistrationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            RegistrationSeeder::class
        ]);
    }
}
