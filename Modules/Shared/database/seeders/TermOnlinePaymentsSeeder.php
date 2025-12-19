<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermOnlinePaymentsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('online_payments')->insert([
            [
                // Common SaaS fields
                'client_id' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,

                // Payment info
                'user_id' => 1,

                // Polymorphic payable
                'payable_type' => 'Modules\\Student\\Models\\StudentFee',
                'payable_id' => 1,

                'amount' => 2500.00,
                'currency' => 'INR',
                'payment_method' => 'UPI',
                'transaction_id' => 'TXN-' . Str::upper(Str::random(10)),
                'notes' => 'Student fee payment via UPI',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,

                'user_id' => 2,
                'payable_type' => 'Modules\\Student\\Models\\StudentFee',
                'payable_id' => 2,

                'amount' => 1800.00,
                'currency' => 'INR',
                'payment_method' => 'Card',
                'transaction_id' => 'TXN-' . Str::upper(Str::random(10)),
                'notes' => 'Exam fee payment',

                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
