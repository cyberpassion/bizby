<?php

namespace Modules\Student\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Student\Models\StudentFeeHead;

class StudentFeeHeadSeeder extends Seeder
{
    public function run()
    {
        StudentFeeHead::factory()->count(10)->create();
    }
}
