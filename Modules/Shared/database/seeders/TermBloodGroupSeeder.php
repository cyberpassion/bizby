<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermBloodGroupSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('terms')->insert([
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'A+',
                'slug'       => 'a-plus',
                'group'      => 'blood_group',
                'module'     => 'student',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 2,
                'status'     => 1,
                'name'       => 'A-',
                'slug'       => 'a-minus',
                'group'      => 'blood_group',
                'module'     => 'student',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'B+',
                'slug'       => 'b-plus',
                'group'      => 'blood_group',
                'module'     => 'student',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 2,
                'status'     => 1,
                'name'       => 'B-',
                'slug'       => 'b-minus',
                'group'      => 'blood_group',
                'module'     => 'student',
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'O+',
                'slug'       => 'o-plus',
                'group'      => 'blood_group',
                'module'     => 'student',
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 2,
                'status'     => 1,
                'name'       => 'O-',
                'slug'       => 'o-minus',
                'group'      => 'blood_group',
                'module'     => 'student',
                'sort_order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'AB+',
                'slug'       => 'ab-plus',
                'group'      => 'blood_group',
                'module'     => 'student',
                'sort_order' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 2,
                'status'     => 1,
                'name'       => 'AB-',
                'slug'       => 'ab-minus',
                'group'      => 'blood_group',
                'module'     => 'student',
                'sort_order' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
