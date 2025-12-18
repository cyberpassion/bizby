<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermBloodGroupSeeder extends Seeder
{
    public function run(): void
    {
        $bloodGroups = [
            'A+',
            'A-',
            'B+',
            'B-',
            'AB+',
            'AB-',
            'O+',
            'O-',
        ];

        $data = [];

        foreach ($bloodGroups as $index => $group) {
            $data[] = [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => $group,
                'slug'       => Str::slug($group), // a-plus, o-minus etc
                'group'      => 'blood_group',
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
