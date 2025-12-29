<?php

namespace Modules\Cashflow\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Cashflow\Database\Seeders\CashflowSeeder;

class CashflowDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            CashflowSeeder::class
        ]);
    }
}
