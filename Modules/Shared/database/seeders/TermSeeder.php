<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TermSeeder extends Seeder
{
    public function run(): void
    {
        $terms = [

            // -------- GENDER ----------
            [ 'name' => 'Male',   'group' => 'gender', 'module' => 'student', 'sort_order' => 1 ],
            [ 'name' => 'Female', 'group' => 'gender', 'module' => 'student', 'sort_order' => 2 ],
            [ 'name' => 'Other',  'group' => 'gender', 'module' => 'student', 'sort_order' => 3 ],

            // -------- CLASS ----------
            [ 'name' => 'LKG', 'group' => 'class', 'module' => 'student', 'sort_order' => 1 ],
            [ 'name' => 'UKG', 'group' => 'class', 'module' => 'student', 'sort_order' => 2 ],
            [ 'name' => 'Class 1', 'group' => 'class', 'module' => 'student', 'sort_order' => 3 ],

			// -------- SECTION ----------
            [ 'name' => 'A', 'group' => 'section', 'module' => 'student', 'sort_order' => 1 ],
            [ 'name' => 'B', 'group' => 'section', 'module' => 'student', 'sort_order' => 2 ],

			// -------- FEE HEADS ----------
            [ 'name' => 'ADMISSION FEE', 'group' => 'feehead', 'module' => 'student', 'sort_order' => 1 ],
            [ 'name' => 'TUTION FEE', 'group' => 'fee-head', 'module' => 'student', 'sort_order' => 2 ],

			// -------- SESSION ----------
            [ 'name' => '2024-25', 'group' => 'session', 'module' => 'student', 'sort_order' => 1 ],
			[ 'name' => '2025-26', 'group' => 'session', 'module' => 'student', 'sort_order' => 2 ],
            [ 'name' => '2026-27', 'group' => 'session', 'module' => 'student', 'sort_order' => 3 ],

            // -------- CATEGORY ----------
            [ 'name' => 'General', 'group' => 'category', 'module' => 'student', 'sort_order' => 1 ],
            [ 'name' => 'OBC',     'group' => 'category', 'module' => 'student', 'sort_order' => 2 ],
            [ 'name' => 'SC',      'group' => 'category', 'module' => 'student', 'sort_order' => 3 ],
            [ 'name' => 'ST',      'group' => 'category', 'module' => 'student', 'sort_order' => 4 ],

        ];

        foreach ($terms as $term) {
            DB::table('terms')->insert([
                'name'          => $term['name'],
                'slug'          => Str::slug($term['name']),
                'group'    => $term['group'],
                'module' 		=> $term['module'],
                'sort_order'    => $term['sort_order'],
                'status'        => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
