<?php

namespace Modules\Student\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StudentFeeTransactionItemSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('student_fee_transaction_items')->insert([
            [
                'transaction_id' => 1,
                'student_fee_id' => 1,
                'amount_paid' => 1500.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'transaction_id' => 2,
                'student_fee_id' => 2,
                'amount_paid' => 5000.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'transaction_id' => 3,
                'student_fee_id' => 3,
                'amount_paid' => 800.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
