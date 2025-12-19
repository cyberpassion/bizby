<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('terms')->insert([]);
    }
}

