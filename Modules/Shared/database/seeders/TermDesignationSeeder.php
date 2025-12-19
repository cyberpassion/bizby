<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermDesignationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('terms')->insert([
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'Principal',
                'slug'       => Str::slug('Principal'),
                'group'      => 'designation',
                'module'     => 'employee',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'Vice Principal',
                'slug'       => Str::slug('Vice Principal'),
                'group'      => 'designation',
                'module'     => 'employee',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'Head of Department',
                'slug'       => Str::slug('Head of Department'),
                'group'      => 'designation',
                'module'     => 'employee',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'Professor',
                'slug'       => Str::slug('Professor'),
                'group'      => 'designation',
                'module'     => 'employee',
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'Assistant Professor',
                'slug'       => Str::slug('Assistant Professor'),
                'group'      => 'designation',
                'module'     => 'employee',
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'Lecturer',
                'slug'       => Str::slug('Lecturer'),
                'group'      => 'designation',
                'module'     => 'employee',
                'sort_order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'Lab Assistant',
                'slug'       => Str::slug('Lab Assistant'),
                'group'      => 'designation',
                'module'     => 'employee',
                'sort_order' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'Clerk',
                'slug'       => Str::slug('Clerk'),
                'group'      => 'designation',
                'module'     => 'employee',
                'sort_order' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
