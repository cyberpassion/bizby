<?php

namespace Modules\Student\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StudentFeeTransactionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('student_fee_transactions')->insert([
            [
                'student_id' => 1,
                'amount' => 1500.00,
                'payment_mode' => 'cash',
                'reference' => null,
                'date' => '2025-12-05',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'student_id' => 1,
                'amount' => 5000.00,
                'payment_mode' => 'online',
                'reference' => 'TXN123456',
                'date' => '2025-12-05',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'student_id' => 2,
                'amount' => 800.00,
                'payment_mode' => 'upi',
                'reference' => 'UPI998877',
                'date' => '2025-12-05',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
