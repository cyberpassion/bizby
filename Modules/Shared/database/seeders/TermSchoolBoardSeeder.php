<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermSchoolBoardSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('terms')->insert([
            [
                'tenant_id'  => 1,
                'status'     => 1,
                'name'       => 'CBSE',
                'slug'       => Str::slug('CBSE'),
                'group'      => 'school-boards',
                'module'     => 'student',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenant_id'  => 1,
                'status'     => 1,
                'name'       => 'ICSE',
                'slug'       => Str::slug('ICSE'),
                'group'      => 'school-boards',
                'module'     => 'student',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenant_id'  => 1,
                'status'     => 1,
                'name'       => 'UP Board',
                'slug'       => Str::slug('UP Board'),
                'group'      => 'school-boards',
                'module'     => 'student',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenant_id'  => 1,
                'status'     => 1,
                'name'       => 'MP Board',
                'slug'       => Str::slug('MP Board'),
                'group'      => 'school-boards',
                'module'     => 'student',
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenant_id'  => 1,
                'status'     => 1,
                'name'       => 'RBSE',
                'slug'       => Str::slug('RBSE'),
                'group'      => 'school-boards',
                'module'     => 'student',
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenant_id'  => 1,
                'status'     => 1,
                'name'       => 'Bihar Board',
                'slug'       => Str::slug('Bihar Board'),
                'group'      => 'school-boards',
                'module'     => 'student',
                'sort_order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
