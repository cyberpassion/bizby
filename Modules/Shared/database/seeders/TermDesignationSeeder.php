<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermDesignationSeeder extends Seeder
{
    public function run(): void
    {
        $designations = [
            ['owner',        'Owner'],
            ['director',     'Director'],
            ['manager',      'Manager'],
            ['team_lead',    'Team Lead'],
            ['executive',    'Executive'],
            ['sales_exec',   'Sales Executive'],
            ['marketing',    'Marketing Executive'],
            ['support',      'Support Executive'],
            ['hr',           'HR'],
            ['accountant',   'Accountant'],
            ['staff',        'Staff'],
            ['intern',       'Intern'],
        ];

        $data = [];

        foreach ($designations as $index => [$slug, $label]) {
            $data[] = [
                'tenant_id'  => 1, // default tenant
                'status'     => 1,
                'name'       => $label,
                'slug'       => $slug,
                'group'      => 'designations',
                'module'     => 'shared',
                'sort_order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('terms')->upsert(
            $data,
            ['slug', 'tenant_id'],
            ['status', 'updated_at']
        );
    }
}
