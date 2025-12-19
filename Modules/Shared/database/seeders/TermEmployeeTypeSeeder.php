<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermEmployeeTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'Permanent',
            'Contract',
            'Temporary',
            'Part Time',
            'Full Time',
            'Intern',
            'Trainee',
            'Consultant',
            'Freelancer',
            'Probation',
            'Apprentice',
            'Other',
        ];

        $data = [];

        foreach ($types as $index => $type) {
            $data[] = [
                'client_id'  => 1, // default / system
                'status'     => 1,
                'name'       => $type,
                'slug'       => Str::slug($type),
                'group'      => 'employee-types',
                'module'     => 'employee',
                'sort_order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('terms')->upsert(
            $data,
            ['slug','client_id'],
            ['status','updated_at']
        );
    }
}
