<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermOnlinePaymentsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('online_payments')->insert([]);
    }
}
