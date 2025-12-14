<?php

namespace Modules\Booking\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Booking\Database\Seeders\BookingSeeder;

class BookingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            BookingSeeder::class
        ]);
    }
}
