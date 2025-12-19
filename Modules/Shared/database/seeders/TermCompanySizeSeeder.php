<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermCompanySizeSeeder extends Seeder
{
    public function run(): void
    {
        $sizes = [
            ['1-10', 'Micro'],
            ['11-50', 'Small'],
            ['51-200', 'Medium'],
            ['201-500', 'Mid Large'],
            ['501-1000', 'Large'],
            ['1000+', 'Enterprise'],
        ];

        $data = [];

        foreach ($sizes as $index => [$range, $label]) {
            $data[] = [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => $label,
                'slug'       => str_replace('+','plus',str_replace('-','_',$range)),
                'group'      => 'company-sizes',
                'module'     => 'shared',
                'sort_order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('terms')->upsert($data, ['slug','client_id'], ['status','updated_at']);
    }
}
