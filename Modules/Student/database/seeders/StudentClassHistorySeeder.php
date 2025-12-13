<?php

namespace Modules\Student\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Student\Models\StudentClassHistory;

class StudentClassHistorySeeder extends Seeder
{
    public function run()
    {
        StudentClassHistory::factory()->count(20)->create();
    }
}
