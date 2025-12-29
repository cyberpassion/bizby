<?php

namespace Modules\Cashflow\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Cashflow\Models\Cashflow;

class CashflowSeeder extends Seeder
{
    public function run(): void
    {
        Cashflow::factory()
            ->count(50)
            ->create();
    }
}
