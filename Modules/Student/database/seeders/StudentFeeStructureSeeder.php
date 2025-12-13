<?php

namespace Modules\Student\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Student\Models\StudentFeeStructure;

class StudentFeeStructureSeeder extends Seeder
{
    public function run()
    {
        StudentFeeStructure::factory()->count(20)->create();
    }
}
