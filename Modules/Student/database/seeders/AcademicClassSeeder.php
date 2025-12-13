<?php

namespace Modules\Student\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Student\Models\AcademicClass;

class AcademicClassSeeder extends Seeder
{
    public function run()
    {
        AcademicClass::factory()->count(10)->create();
    }
}
