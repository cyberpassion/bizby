<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('terms')->insert([
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'General',
                'slug'       => Str::slug('General'),
                'group'      => 'categories',
                'module'     => 'shared',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'OBC',
                'slug'       => Str::slug('OBC'),
                'group'      => 'categories',
                'module'     => 'shared',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'SC',
                'slug'       => Str::slug('SC'),
                'group'      => 'categories',
                'module'     => 'shared',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'ST',
                'slug'       => Str::slug('ST'),
                'group'      => 'categories',
                'module'     => 'shared',
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'EWS',
                'slug'       => Str::slug('EWS'),
                'group'      => 'categories',
                'module'     => 'shared',
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
