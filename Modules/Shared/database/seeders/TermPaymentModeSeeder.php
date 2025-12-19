<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermPaymentModeSeeder extends Seeder
{
    public function run(): void
    {
        $paymentModes = [

            /* ---------- Cash ---------- */
            'Cash',

            /* ---------- Banking ---------- */
            'Cheque',
            'Demand Draft (DD)',
            'NEFT',
            'RTGS',
            'IMPS',
            'UPI',

            /* ---------- Cards ---------- */
            'Debit Card',
            'Credit Card',
            'Prepaid Card',

            /* ---------- Digital Wallets ---------- */
            'Paytm',
            'PhonePe',
            'Google Pay',
            'Amazon Pay',
            'Mobikwik',
            'Freecharge',

            /* ---------- Online / Gateway ---------- */
            'Net Banking',
            'Payment Gateway',
            'QR Code Payment',

            /* ---------- EMI / Credit ---------- */
            'EMI',
            'Buy Now Pay Later (BNPL)',
            'Loan / Credit',

            /* ---------- Government / Institutional ---------- */
            'E-Challan',
            'Treasury Payment',

            /* ---------- International ---------- */
            'International Card',
            'SWIFT Transfer',

            /* ---------- Other ---------- */
            'Crypto Currency',
            'Other'
        ];

        foreach ($paymentModes as $index => $mode) {
            DB::table('terms')->updateOrInsert(
                [
                    'slug'  => Str::slug($mode),
                    'group' => 'payment_mode',
                ],
                [
                    'client_id'  => 1,
                    'status'     => 1,
                    'name'       => $mode,
                    'module'     => 'payment',
                    'sort_order' => $index + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}