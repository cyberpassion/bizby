<?php

namespace Modules\Student\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StudentFeeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('student_fees')->insert([
            [
                'student_id' => 1,
                'fee_head_id' => 1,
                'academic_year' => '2024-2025',
                'period_code' => 'M1',
                'period_label' => 'June',
                'payable' => 1500.00,
                'concession' => 0.00,
                'is_active' => 1,
                'cancelled_at' => null,
                'cancel_reason' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'student_id' => 1,
                'fee_head_id' => 2,
                'academic_year' => '2024-2025',
                'period_code' => 'ONETIME',
                'period_label' => 'Admission',
                'payable' => 5000.00,
                'concession' => 500.00,
                'is_active' => 1,
                'cancelled_at' => null,
                'cancel_reason' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'student_id' => 2,
                'fee_head_id' => 1,
                'academic_year' => '2024-2025',
                'period_code' => 'M1',
                'period_label' => 'June',
                'payable' => 1500.00,
                'concession' => 100.00,
                'is_active' => 1,
                'cancelled_at' => null,
                'cancel_reason' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
