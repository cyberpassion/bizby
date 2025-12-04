<?php

namespace Modules\Attendance\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Attendance\Database\Seeders\AttendanceSeeder;

class AttendanceDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $this->call([
            AttendanceSeeder::class
         ]);
    }
}
