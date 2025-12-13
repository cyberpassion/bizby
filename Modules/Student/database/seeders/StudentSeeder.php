<?php

namespace Modules\Student\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Student\Models\Student;

class StudentSeeder extends Seeder
{
    public function run()
    {
        Student::factory()->count(20)->create();
    }
}
