<?php

namespace Modules\Checklist\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Checklist\Database\Seeders\ChecklistSeeder;

class ChecklistDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            ChecklistSeeder::class,
        ]);
    }
}
