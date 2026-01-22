<?php

namespace Modules\Shared\Database\Seeders\Terms;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermLanguageSeeder extends Seeder
{
    public function run(): void
    {
        $languages = [

            // Indian Languages
            ['Hindi', 'hi'],
            ['English', 'en'],
            ['Bengali', 'bn'],
            ['Telugu', 'te'],
            ['Marathi', 'mr'],
            ['Tamil', 'ta'],
            ['Urdu', 'ur'],
            ['Gujarati', 'gu'],
            ['Kannada', 'kn'],
            ['Malayalam', 'ml'],
            ['Odia', 'or'],
            ['Punjabi', 'pa'],
            ['Assamese', 'as'],
            ['Maithili', 'mai'],
            ['Sanskrit', 'sa'],

            // Global Languages
            ['Spanish', 'es'],
            ['French', 'fr'],
            ['German', 'de'],
            ['Italian', 'it'],
            ['Portuguese', 'pt'],
            ['Russian', 'ru'],
            ['Chinese', 'zh'],
            ['Japanese', 'ja'],
            ['Korean', 'ko'],
            ['Arabic', 'ar'],
        ];

        $data = [];
        $order = 1;

        foreach ($languages as [$name, $code]) {
            $data[] = [
                'tenant_id'  => 1,
                'status'     => 1,
                'name'       => $name,
                'slug'       => $code, // short code slug
                'group'      => 'languages',
                'module'     => 'shared',
                'sort_order' => $order++,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('terms')->upsert(
            $data,
            ['slug', 'tenant_id'],
            ['status', 'updated_at']
        );
    }
}
