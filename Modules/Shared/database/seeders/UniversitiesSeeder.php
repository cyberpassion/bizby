<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UniversitySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('terms')->insert([
            [
                'name' => 'University of Delhi',
                'type' => 'Central',
                'state' => 'Delhi',
                'city' => 'Delhi',
                'contact_phone' => '011-27667010',
                'website' => 'http://www.du.ac.in',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jawaharlal Nehru University',
                'type' => 'Central',
                'state' => 'Delhi',
                'city' => 'Delhi',
                'contact_phone' => '011-26704172',
                'website' => 'http://www.jnu.ac.in',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Banaras Hindu University',
                'type' => 'Central',
                'state' => 'Uttar Pradesh',
                'city' => 'Varanasi',
                'contact_phone' => '0542-2368176',
                'website' => 'http://www.bhu.ac.in',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'University of Mumbai',
                'type' => 'State',
                'state' => 'Maharashtra',
                'city' => 'Mumbai',
                'contact_phone' => '022-26526001',
                'website' => 'http://www.mu.ac.in',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Osmania University',
                'type' => 'State',
                'state' => 'Telangana',
                'city' => 'Hyderabad',
                'contact_phone' => '040-27098100',
                'website' => 'http://www.osmania.ac.in',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

