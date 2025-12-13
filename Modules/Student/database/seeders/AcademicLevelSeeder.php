<?php

namespace Modules\Student\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Student\Models\AcademicLevel;

class AcademicLevelSeeder extends Seeder
{
    public function run()
    {
        AcademicLevel::factory()->count(5)->create();
    }
}
