<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermIndianStateSeeder extends Seeder
{
    public function run(): void
    {
        $states = [

            // States
            ['Andhra Pradesh', 'AP'],
            ['Arunachal Pradesh', 'AR'],
            ['Assam', 'AS'],
            ['Bihar', 'BR'],
            ['Chhattisgarh', 'CG'],
            ['Goa', 'GA'],
            ['Gujarat', 'GJ'],
            ['Haryana', 'HR'],
            ['Himachal Pradesh', 'HP'],
            ['Jharkhand', 'JH'],
            ['Karnataka', 'KA'],
            ['Kerala', 'KL'],
            ['Madhya Pradesh', 'MP'],
            ['Maharashtra', 'MH'],
            ['Manipur', 'MN'],
            ['Meghalaya', 'ML'],
            ['Mizoram', 'MZ'],
            ['Nagaland', 'NL'],
            ['Odisha', 'OD'],
            ['Punjab', 'PB'],
            ['Rajasthan', 'RJ'],
            ['Sikkim', 'SK'],
            ['Tamil Nadu', 'TN'],
            ['Telangana', 'TS'],
            ['Tripura', 'TR'],
            ['Uttar Pradesh', 'UP'],
            ['Uttarakhand', 'UK'],
            ['West Bengal', 'WB'],

            // Union Territories
            ['Andaman and Nicobar Islands', 'AN'],
            ['Chandigarh', 'CH'],
            ['Dadra and Nagar Haveli and Daman and Diu', 'DN'],
            ['Delhi', 'DL'],
            ['Jammu and Kashmir', 'JK'],
            ['Ladakh', 'LA'],
            ['Lakshadweep', 'LD'],
            ['Puducherry', 'PY'],
        ];

        $data = [];
        $order = 1;

        foreach ($states as [$name, $code]) {
            $data[] = [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => $name,
                'slug'       => strtolower($code), // ap, mh, dl
                'group'      => 'indian-states',
                'module'     => 'shared',
                'sort_order' => $order++,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('terms')->upsert(
            $data,
            ['slug', 'client_id'],
            ['status', 'updated_at']
        );
    }
}
