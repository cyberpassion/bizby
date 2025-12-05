<?php

namespace Modules\Student\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StudentClassHistorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('student_class_history')->insert([
            [
                'student_id' => 1,
                'academic_year' => '2024-2025',
                'from_date' => '2024-06-01',
                'to_date' => '2024-06-01',
                'status' => 'present',
                'reason' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'student_id' => 1,
                'academic_year' => '2024-2025',
                'from_date' => '2024-06-02',
                'to_date' => '2024-06-02',
                'status' => 'absent',
                'reason' => 'Sick leave',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'student_id' => 2,
                'academic_year' => '2024-2025',
                'from_date' => '2024-06-01',
                'to_date' => '2024-06-01',
                'status' => 'present',
                'reason' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
