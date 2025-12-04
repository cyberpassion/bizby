<?php

namespace Modules\Note\Database\Seeders;

use Illuminate\Database\Seeder;

Use Modules\Note\Database\Seeders\NoteSeeder;

class NoteDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            NoteSeeder::class
        ]);
    }
}
