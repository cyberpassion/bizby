<?php

namespace Modules\Consultation\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Consultation\Database\Seeders\ConsultationSeeder;

class ConsultationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            ConsultationSeeder::class
        ]);
    }
}
