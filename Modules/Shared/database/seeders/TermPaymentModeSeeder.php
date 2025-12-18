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
		  "Cash",
		  "UPI",
		  "Credit Card",
		  "Debit Card",
		  "Net Banking",
		  "Wallet",
		  "EMI",
		  "Pay Later",
		  "QR Code",
		  "Bank Transfer",
		  "Mobile Banking"
		];

        $data = [];
        $order = 1;

        foreach ($paymentModes as $paymentMode) {
            $data[] = [
                'client_id'   => 1,
                'status'      => 1,
                'name'        => $paymentMode,
                'slug'        => Str::slug($paymentMode),
                'group'       => 'online_payment',
                'module'      => 'shared',
                'sort_order'  => $order++,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }
    }
}
