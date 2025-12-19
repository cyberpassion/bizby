<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermBankSeeder extends Seeder
{
    public function run(): void
    {
        $banks = [

            /* ---------- Public Sector Banks ---------- */
            'State Bank of India',
            'Punjab National Bank',
            'Bank of Baroda',
            'Canara Bank',
            'Union Bank of India',
            'Bank of India',
            'Central Bank of India',
            'Indian Bank',
            'Indian Overseas Bank',
            'UCO Bank',
            'Bank of Maharashtra',
            'Punjab & Sind Bank',

            /* ---------- Private Sector Banks ---------- */
            'HDFC Bank',
            'ICICI Bank',
            'Axis Bank',
            'Kotak Mahindra Bank',
            'IndusInd Bank',
            'Yes Bank',
            'IDFC First Bank',
            'Federal Bank',
            'South Indian Bank',
            'Karnataka Bank',
            'Karur Vysya Bank',
            'City Union Bank',
            'RBL Bank',
            'Bandhan Bank',
            'DCB Bank',
            'Tamilnad Mercantile Bank',
            'Jammu & Kashmir Bank',
            'CSB Bank',

            /* ---------- Small Finance Banks ---------- */
            'AU Small Finance Bank',
            'Ujjivan Small Finance Bank',
            'Jana Small Finance Bank',
            'Equitas Small Finance Bank',
            'Suryoday Small Finance Bank',
            'Utkarsh Small Finance Bank',
            'ESAF Small Finance Bank',
            'North East Small Finance Bank',
            'Capital Small Finance Bank',
            'Unity Small Finance Bank',
            'Shivalik Small Finance Bank',

            /* ---------- Payment Banks ---------- */
            'Airtel Payments Bank',
            'India Post Payments Bank',
            'Fino Payments Bank',
            'Paytm Payments Bank',

        ];

        foreach ($banks as $index => $bank) {
            DB::table('terms')->updateOrInsert(
                [
                    'slug' => Str::slug($bank),
                    'group' => 'bank',
                ],
                [
                    'client_id'  => 1,
                    'status'     => 1,
                    'name'       => $bank,
                    'module'     => 'finance',
                    'sort_order' => $index + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}