<?php

namespace Modules\Cashflow\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CashTransactionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cash_transactions')->insert([
            [
                'reference_id'   => 1,
                'reference_type' => 'student',
                'amount'         => 2500.00,
                'status'         => 'completed',
                'received_by'    => 'admin',
                'description'    => 'Student fee received via UPI',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'reference_id'   => 2,
                'reference_type' => 'student',
                'amount'         => 1800.00,
                'status'         => 'completed',
                'received_by'    => 'admin',
                'description'    => 'Exam fee payment',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
