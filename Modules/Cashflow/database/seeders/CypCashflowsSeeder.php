<?php

namespace Modules\Cashflow\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CypCashflowsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cashflows')->insert([
            [
                'source'           => 'Student Fee',
                'type'             => 'income',
                'amount'           => 2500.00,
                'description'      => 'Student fee received via UPI',
                'transaction_date' => now()->toDateString(),
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'source'           => 'Exam Fee',
                'type'             => 'income',
                'amount'           => 1800.00,
                'description'      => 'Exam fee payment',
                'transaction_date' => now()->toDateString(),
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ]);
    }
}
