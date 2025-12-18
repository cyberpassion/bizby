<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermSchoolBoardSeeder extends Seeder
{
    public function run(): void
    {
        $boards = [
            // National Boards
            'CBSE',
            'ICSE',
            'CISCE',
            'NIOS',
            'IB',
            'Cambridge (IGCSE)',

            // State Boards
            'Andhra Pradesh Board of Secondary Education',
            'Telangana Board of Secondary Education',
            'Assam Higher Secondary Education Council',
            'Bihar School Examination Board',
            'Chhattisgarh Board of Secondary Education',
            'Goa Board of Secondary and Higher Secondary Education',
            'Gujarat Secondary and Higher Secondary Education Board',
            'Haryana Board of School Education',
            'Himachal Pradesh Board of School Education',
            'Jammu and Kashmir Board of School Education',
            'Jharkhand Academic Council',
            'Karnataka Secondary Education Examination Board',
            'Kerala Board of Public Examinations',
            'Madhya Pradesh Board of Secondary Education',
            'Maharashtra State Board of Secondary and Higher Secondary Education',
            'Manipur Board of Secondary Education',
            'Meghalaya Board of School Education',
            'Mizoram Board of School Education',
            'Nagaland Board of School Education',
            'Odisha Board of Secondary Education',
            'Punjab School Education Board',
            'Rajasthan Board of Secondary Education',
            'Tamil Nadu State Board',
            'Tripura Board of Secondary Education',
            'Uttar Pradesh Board of High School and Intermediate Education',
            'Uttarakhand Board of School Education',
            'West Bengal Board of Secondary Education',

            // Other / Regional
            'Delhi Board of School Education (DBSE)',
            'Sikkim State Board',
            'Arunachal Pradesh Board',
        ];

        $data = [];

        foreach ($boards as $index => $board) {
            $data[] = [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => $board,
                'slug'       => Str::slug($board),
                'group'      => 'school_board',
                'module'     => 'shared',
                'sort_order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('terms')->insert($data);
    }
}
