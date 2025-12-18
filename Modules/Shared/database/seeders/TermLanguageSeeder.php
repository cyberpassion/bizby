<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermLanguageSeeder extends Seeder
{
    public function run(): void
    {
        $languages = [

            // Indian Languages
            'Hindi',
            'English',
            'Bengali',
            'Telugu',
            'Marathi',
            'Tamil',
            'Urdu',
            'Gujarati',
            'Kannada',
            'Malayalam',
            'Odia',
            'Punjabi',
            'Assamese',
            'Maithili',
            'Sanskrit',

            // Global Languages
            'Spanish',
            'French',
            'German',
            'Italian',
            'Portuguese',
            'Russian',
            'Chinese',
            'Japanese',
            'Korean',
            'Arabic',
        ];

        $data = [];

        foreach ($languages as $index => $language) {
            $data[] = [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => $language,
                'slug'       => Str::slug($language),
                'group'      => 'language',
                'module'     => 'shared',
                'sort_order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('terms')->upsert(
            $data,
            ['slug', 'client_id'],
            ['status', 'updated_at']
        );
    }
}
