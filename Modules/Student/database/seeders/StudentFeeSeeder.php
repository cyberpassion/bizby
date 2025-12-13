<?php

namespace Modules\Student\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Student\Models\StudentFee;

class StudentFeeSeeder extends Seeder
{
    public function run()
    {
        StudentFee::factory()->count(20)->create();
    }
}
