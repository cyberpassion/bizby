<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermUniversitySeeder extends Seeder
{
    public function run(): void
    {
        $universities = [

            // Central Universities
            'University of Delhi',
            'Jawaharlal Nehru University',
            'Banaras Hindu University',
            'Aligarh Muslim University',
            'Jamia Millia Islamia',
            'University of Hyderabad',
            'Visva-Bharati University',
            'Central University of Rajasthan',
            'Central University of Punjab',

            // IITs
            'Indian Institute of Technology Bombay',
            'Indian Institute of Technology Delhi',
            'Indian Institute of Technology Madras',
            'Indian Institute of Technology Kanpur',
            'Indian Institute of Technology Kharagpur',
            'Indian Institute of Technology Roorkee',
            'Indian Institute of Technology Guwahati',
            'Indian Institute of Technology Hyderabad',

            // NITs
            'National Institute of Technology Trichy',
            'National Institute of Technology Surathkal',
            'National Institute of Technology Warangal',
            'National Institute of Technology Calicut',
            'National Institute of Technology Rourkela',

            // State Universities
            'University of Mumbai',
            'Savitribai Phule Pune University',
            'University of Calcutta',
            'University of Madras',
            'Osmania University',
            'Andhra University',
            'Anna University',
            'Bangalore University',
            'University of Rajasthan',
            'University of Lucknow',
            'Patna University',
            'Ranchi University',
            'Utkal University',
            'Gauhati University',
            'Punjab University Chandigarh',

            // Deemed / Private Universities
            'Vellore Institute of Technology',
            'Manipal Academy of Higher Education',
            'Amity University',
            'Lovely Professional University',
            'Symbiosis International University',
            'Birla Institute of Technology and Science',
            'SRM Institute of Science and Technology',
            'Shiv Nadar University',
            'Ashoka University',
            'OP Jindal Global University',
        ];

        $data = [];

        foreach ($universities as $index => $university) {
            $data[] = [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => $university,
                'slug'       => Str::slug($university),
                'group'      => 'universities',
                'module'     => 'shared',
                'sort_order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('terms')->insert($data);
    }
}
