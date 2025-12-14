<?php

namespace Modules\Announcement\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Announcement\Database\Seeders\AnnouncementSeeder;

class AnnouncementDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            // Admin module seeders
            AnnouncementSeeder::class
        ]);
    }
}
