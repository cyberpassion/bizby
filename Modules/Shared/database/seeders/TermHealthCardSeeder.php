<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermHealthCardSeeder extends Seeder
{
    public function run(): void
    {
        $healthCards = [

            // Government Schemes
            'Ayushman Bharat (PM-JAY)',
            'ESIC (Employee State Insurance)',
            'CGHS (Central Government Health Scheme)',
            'State Government Health Scheme',

            // Insurance / Health Cards
            'Health Insurance Card',
            'Mediclaim Policy',
            'Cashless Health Card',

            // Defence / PSU
            'ECHS (Ex-Servicemen Contributory Health Scheme)',
            'Railway Health Card',
            'PSU Health Scheme',

            // Other
            'Private Hospital Health Card',
            'Corporate Health Card',
            'No Health Card',
            'Other',
        ];

        $data = [];

        foreach ($healthCards as $index => $card) {
            $data[] = [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => $card,
                'slug'       => Str::slug($card),
                'group'      => 'health-cards',
                'module'     => 'patient',
                'sort_order' => $index + 1,
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
