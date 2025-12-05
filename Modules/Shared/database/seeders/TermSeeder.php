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
            [ 'name' => 'Male',   'group_name' => 'gender', 'linked_module' => 'student', 'sort_order' => 1 ],
            [ 'name' => 'Female', 'group_name' => 'gender', 'linked_module' => 'student', 'sort_order' => 2 ],
            [ 'name' => 'Other',  'group_name' => 'gender', 'linked_module' => 'student', 'sort_order' => 3 ],

            // -------- CLASS ----------
            [ 'name' => 'LKG', 'group_name' => 'class', 'linked_module' => 'student', 'sort_order' => 1 ],
            [ 'name' => 'UKG', 'group_name' => 'class', 'linked_module' => 'student', 'sort_order' => 2 ],
            [ 'name' => 'Class 1', 'group_name' => 'class', 'linked_module' => 'student', 'sort_order' => 3 ],

            // -------- CATEGORY ----------
            [ 'name' => 'General', 'group_name' => 'category', 'linked_module' => 'student', 'sort_order' => 1 ],
            [ 'name' => 'OBC',     'group_name' => 'category', 'linked_module' => 'student', 'sort_order' => 2 ],
            [ 'name' => 'SC',      'group_name' => 'category', 'linked_module' => 'student', 'sort_order' => 3 ],
            [ 'name' => 'ST',      'group_name' => 'category', 'linked_module' => 'student', 'sort_order' => 4 ],

        ];

        foreach ($terms as $term) {
            DB::table('terms')->insert([
                'name'          => $term['name'],
                'slug'          => Str::slug($term['name']),
                'group_name'    => $term['group_name'],
                'linked_module' => $term['linked_module'],
                'sort_order'    => $term['sort_order'],
                'status'        => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
