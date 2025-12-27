<?php

namespace Modules\Leaveapplication\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Leaveapplication\Models\Leaveapplication;

class LeaveapplicationSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            // Create 20 leave applications
            Leaveapplication::factory()
                ->count(20)
                ->create();
        });
    }
}
