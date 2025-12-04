<?php

namespace Modules\Patient\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Patient\Database\Seeders\PatientSeeder;

class PatientDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            PatientSeeder::class
        ]);
    }
}
