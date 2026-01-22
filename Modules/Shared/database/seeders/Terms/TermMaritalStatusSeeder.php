<?php

namespace Modules\Shared\Database\Seeders\Terms;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermMaritalStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            'Single',
            'Married',
            'Widowed',
            'Divorced',
            'Separated',
            'Annulled',
        ];

        $data = [];

        foreach ($statuses as $index => $status) {
            $data[] = [
                'tenant_id'  => 1,
                'status'     => 1,
                'name'       => $status,
                'slug'       => Str::slug($status), // single, married, widowed...
                'group'      => 'marital-statuses',
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
