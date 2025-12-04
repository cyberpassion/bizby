<?php

namespace Modules\Employee\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Employee\Database\Seeders\EmployeeSeeder;

class EmployeeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            EmployeeSeeder::class
        ]);
    }
}
