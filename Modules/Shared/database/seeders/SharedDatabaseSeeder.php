<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Shared\Database\Seeders\TermSeeder;

class SharedDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            TermSeeder::class
        ]);
    }
}
