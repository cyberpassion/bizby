<?php

namespace Modules\Student\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StudentFeeHeadSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('student_fee_heads')->insert([
            [
                'name' => 'Tuition Fee',
                'frequency' => 'monthly',
                'default_amount' => 1500.00,
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Admission Fee',
                'frequency' => 'one-time',
                'default_amount' => 5000.00,
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Transport Fee',
                'frequency' => 'monthly',
                'default_amount' => 800.00,
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Exam Fee',
                'frequency' => 'quarterly',
                'default_amount' => 300.00,
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
