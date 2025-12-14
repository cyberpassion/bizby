<?php

namespace Modules\Cashflow\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CashflowSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cashflows_old')->insert([
            [
                // commonSaasFields()
                'client_id' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),

                'entry_source' => 'system',
                'entry_source_ref_id' => null,
                'remark' => 'Student fee received via UPI',
                'system_remark' => 'Seeded data',
                'meta_info' => null,

                // Module specific fields
                'cash_id' => 1001,
                'parent_id' => 0,

                'cash_flow' => 'IN',
                'cash_context' => 'STUDENT_FEE',
                'cash_context_id' => 1,

                'pattern_name' => 'Student Fee Collection',
                'cash_type' => 'FEE',
                'session' => '2025-26',

                'payee_type' => 'student',
                'payee_id' => '1',

                'payable' => '2500',
                'paid' => '2500',
                'balance' => '0',
                'concession' => '0',

                'cash_code' => 'CF-1001',

                'cash_type_remark' => 'Fee received successfully',
                'fee_remark' => 'Full payment',

                'payment_order_id' => 'ORD-1001',
                'payment_transaction_id' => 'TXN-1001',
                'payment_confirmation' => 'SUCCESS',

                'additional_info' => 'Paid via UPI',
                'payment_mode' => 'UPI',

                'user_id' => 1,

                'entry_by' => 'system',
                'entry_by_type' => 'admin',
                'entry_by_id' => 1,

                'is_captured' => 1,
                'is_refunded' => 0,

                'verified_by' => 'admin',
                'thread_parent' => null,
            ]
        ]);
    }
}
