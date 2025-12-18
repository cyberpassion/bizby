<?php

namespace Modules\Contact\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Contact\Database\Seeders\ContactSeeder;

class ContactDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            ContactSeeder::class,
        ]);
    }
}
