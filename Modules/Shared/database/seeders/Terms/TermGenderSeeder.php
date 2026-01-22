<?php

namespace Modules\Shared\Database\Seeders\Terms;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermGenderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('terms')->insert([
            [
                'tenant_id'  => 1,
                'status'     => 1,
                'name'       => 'Male',
                'slug'       => Str::slug('Male'),
                'group'      => 'genders',
                'module'     => 'shared',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenant_id'  => 1,
                'status'     => 1,
                'name'       => 'Female',
                'slug'       => Str::slug('Female'),
                'group'      => 'genders',
                'module'     => 'shared',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenant_id'  => 1,
                'status'     => 1,
                'name'       => 'Other',
                'slug'       => Str::slug('Other'),
                'group'      => 'genders',
                'module'     => 'shared',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}