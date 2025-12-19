<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermDesignationSeeder extends Seeder
{
    public function run(): void
    {
        $designations = [
            'Owner',
            'Founder',
            'Director',
            'Managing Director',
            'Chief Executive Officer',
            'Chief Technology Officer',
            'Chief Financial Officer',

            'Vice President',
            'General Manager',
            'Assistant General Manager',

            'Manager',
            'Assistant Manager',
            'Team Lead',
            'Supervisor',

            'Senior Executive',
            'Executive',
            'Junior Executive',

            'Officer',
            'Associate',
            'Staff',

            'Intern',
            'Trainee',
            'Other',
        ];

        $data = [];

        foreach ($designations as $index => $designation) {
            $data[] = [
                'client_id'  => 1, // system default
                'status'     => 1,
                'name'       => $designation,
                'slug'       => Str::slug($designation),
                'group'      => 'designations',
                'module'     => 'shared',
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
