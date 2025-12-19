<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermReligionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('terms')->insert([
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'Hindu',
                'slug'       => Str::slug('Hindu'),
                'group'      => 'religions',
                'module'     => 'shared',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'Muslim',
                'slug'       => Str::slug('Muslim'),
                'group'      => 'religions',
                'module'     => 'shared',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'Christian',
                'slug'       => Str::slug('Christian'),
                'group'      => 'religions',
                'module'     => 'shared',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'Sikh',
                'slug'       => Str::slug('Sikh'),
                'group'      => 'religions',
                'module'     => 'shared',
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'Buddhist',
                'slug'       => Str::slug('Buddhist'),
                'group'      => 'religions',
                'module'     => 'shared',
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'Jain',
                'slug'       => Str::slug('Jain'),
                'group'      => 'religions',
                'module'     => 'shared',
                'sort_order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'Others',
                'slug'       => Str::slug('Others'),
                'group'      => 'religions',
                'module'     => 'shared',
                'sort_order' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
