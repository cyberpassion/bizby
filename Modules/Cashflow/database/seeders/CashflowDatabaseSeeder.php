<?php

namespace Modules\Cashflow\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Cashflow\Database\Seeders\CashflowSeeder;
use Modules\Cashflow\Database\Seeders\CashTransactionSeeder;
use Modules\Cashflow\Database\Seeders\CypCashflowsSeeder;

class CashflowDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            CashflowSeeder::class,
            CashTransaction::class,
            CypCashflowsSeeder::class,
        ]);
    }
}
