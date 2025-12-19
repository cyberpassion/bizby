<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermCasteSeeder extends Seeder
{
    public function run(): void
    {
        $castes = [
            'Agarwal',
            'Ahir',
            'Arora',
            'Bania',
            'Bhumihar',
            'Brahmin',
            'Chamar',
            'Chettiar',
            'Gond',
            'Gujjar',
            'Jain',
            'Jat',
            'Jatav',
            'Kayastha',
            'Khatri',
            'Koli',
            'Kurmi',
            'Kumhar',
            'Lingayat',
            'Lohar',
            'Mahar',
            'Maratha',
            'Meena',
            'Munda',
            'Nadar',
            'Nai',
            'Naidu',
            'Oraon',
            'Pasi',
            'Patel',
            'Rajput',
            'Reddy',
            'Saini',
            'Santhal',
            'Sheikh',
            'Sonar',
            'Teli',
            'Thakur',
            'Valmiki',
            'Vanniyar',
            'Vokkaliga',
            'Yadav',
        ];

        $data = [];

        foreach ($castes as $index => $caste) {
            $data[] = [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => $caste,
                'slug'       => Str::slug($caste),
                'group'      => 'castes',
                'module'     => 'shared',
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
