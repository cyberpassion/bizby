<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('terms')->insert([
            [
                'client_id' => 1,
                'status' => 1,
                'name' => 'Active',
                'slug' => Str::slug('Active'),
                'group' => 'status',
                'module' => null,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id' => 2,
                'status' => 1,
                'name' => 'Inactive',
                'slug' => Str::slug('Inactive'),
                'group' => 'status',
                'module' => null,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id' => 1,
                'status' => 1,
                'name' => 'Male',
                'slug' => Str::slug('Male'),
                'group' => 'gender',
                'module' => 'student',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id' => 2,
                'status' => 1,
                'name' => 'Female',
                'slug' => Str::slug('Female'),
                'group' => 'gender',
                'module' => 'student',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
