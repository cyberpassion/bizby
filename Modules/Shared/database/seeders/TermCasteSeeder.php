<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermCasteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('terms')->insert([
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'General',
                'slug'       => 'general-caste',
                'group'      => 'caste',
                'module'     => 'student',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'OBC',
                'slug'       => 'obc-caste',
                'group'      => 'caste',
                'module'     => 'student',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'SC',
                'slug'       => 'sc-caste',
                'group'      => 'caste',
                'module'     => 'student',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'ST',
                'slug'       => 'st-caste',
                'group'      => 'caste',
                'module'     => 'student',
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => 'EWS',
                'slug'       => 'ews-caste',
                'group'      => 'caste',
                'module'     => 'student',
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
