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
