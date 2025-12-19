<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermUniversitiesSeeder extends Seeder
{
    public function run(): void
    {
        $universities = [

            // ================= CENTRAL UNIVERSITIES =================
            ['name' => 'University of Delhi', 'group' => 'central_university'],
            ['name' => 'Jawaharlal Nehru University', 'group' => 'central_university'],
            ['name' => 'Banaras Hindu University', 'group' => 'central_university'],
            ['name' => 'Aligarh Muslim University', 'group' => 'central_university'],
            ['name' => 'Jamia Millia Islamia', 'group' => 'central_university'],
            ['name' => 'University of Hyderabad', 'group' => 'central_university'],
            ['name' => 'Pondicherry University', 'group' => 'central_university'],
            ['name' => 'Visva-Bharati University', 'group' => 'central_university'],
            ['name' => 'Tezpur University', 'group' => 'central_university'],
            ['name' => 'Assam University', 'group' => 'central_university'],
            ['name' => 'Nagaland University', 'group' => 'central_university'],
            ['name' => 'Tripura University', 'group' => 'central_university'],
            ['name' => 'Sikkim University', 'group' => 'central_university'],
            ['name' => 'Central University of Rajasthan', 'group' => 'central_university'],
            ['name' => 'Central University of Gujarat', 'group' => 'central_university'],
            ['name' => 'Central University of Haryana', 'group' => 'central_university'],
            ['name' => 'Central University of Punjab', 'group' => 'central_university'],
            ['name' => 'Central University of Kerala', 'group' => 'central_university'],
            ['name' => 'Central University of Tamil Nadu', 'group' => 'central_university'],
            ['name' => 'Central University of South Bihar', 'group' => 'central_university'],

            // ================= STATE UNIVERSITIES =================
            ['name' => 'University of Mumbai', 'group' => 'state_university'],
            ['name' => 'Savitribai Phule Pune University', 'group' => 'state_university'],
            ['name' => 'Osmania University', 'group' => 'state_university'],
            ['name' => 'Kakatiya University', 'group' => 'state_university'],
            ['name' => 'University of Calcutta', 'group' => 'state_university'],
            ['name' => 'Jadavpur University', 'group' => 'state_university'],
            ['name' => 'University of Madras', 'group' => 'state_university'],
            ['name' => 'Annamalai University', 'group' => 'state_university'],
            ['name' => 'Patna University', 'group' => 'state_university'],
            ['name' => 'Ranchi University', 'group' => 'state_university'],
            ['name' => 'University of Rajasthan', 'group' => 'state_university'],
            ['name' => 'Maharaja Sayajirao University of Baroda', 'group' => 'state_university'],
            ['name' => 'Utkal University', 'group' => 'state_university'],
            ['name' => 'Kerala University', 'group' => 'state_university'],
            ['name' => 'Gujarat University', 'group' => 'state_university'],

            // ================= DEEMED UNIVERSITIES =================
            ['name' => 'Vellore Institute of Technology', 'group' => 'deemed_university'],
            ['name' => 'SRM Institute of Science and Technology', 'group' => 'deemed_university'],
            ['name' => 'Manipal Academy of Higher Education', 'group' => 'deemed_university'],
            ['name' => 'Jamia Hamdard', 'group' => 'deemed_university'],
            ['name' => 'Symbiosis International University', 'group' => 'deemed_university'],
            ['name' => 'Bharati Vidyapeeth', 'group' => 'deemed_university'],
            ['name' => 'Tata Institute of Social Sciences', 'group' => 'deemed_university'],
            ['name' => 'Narsee Monjee Institute of Management Studies', 'group' => 'deemed_university'],
            ['name' => 'Homi Bhabha National Institute', 'group' => 'deemed_university'],

            // ================= PRIVATE UNIVERSITIES =================
            ['name' => 'Amity University Noida', 'group' => 'private_university'],
            ['name' => 'Lovely Professional University', 'group' => 'private_university'],
            ['name' => 'Sharda University', 'group' => 'private_university'],
            ['name' => 'Chandigarh University', 'group' => 'private_university'],
            ['name' => 'UPES Dehradun', 'group' => 'private_university'],
            ['name' => 'Bennett University', 'group' => 'private_university'],
            ['name' => 'Ashoka University', 'group' => 'private_university'],
            ['name' => 'OP Jindal Global University', 'group' => 'private_university'],
            ['name' => 'Galgotias University', 'group' => 'private_university'],
            ['name' => 'Parul University', 'group' => 'private_university'],
        ];

        $data = [];
        $sort = 1;

        foreach ($universities as $uni) {
            $data[] = [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => $uni['name'],
                'slug'       => Str::slug($uni['name']),
                'group'      => $uni['group'],   // central / state / deemed / private
                'module'     => 'education',
                'sort_order' => $sort++,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('terms')->insert($data);
    }
}
