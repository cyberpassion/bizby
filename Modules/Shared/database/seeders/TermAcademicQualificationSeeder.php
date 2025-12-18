<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermAcademicQualificationSeeder extends Seeder
{
    public function run(): void
    {
        $qualifications = [

            // School Level
            'Primary School',
            'Middle School',
            'High School (10th)',
            'Higher Secondary (12th)',
            'ITI',
            'Diploma',

            // Undergraduate
            'BA',
            'BSc',
            'BCom',
            'BCA',
            'BBA',
            'BTech',
            'BE',
            'BArch',
            'BPharma',
            'BEd',
            'LLB',
            'MBBS',
            'BDS',
            'BAMS',
            'BHMS',
            'BUMS',
            'BNYS',
            'BSc Nursing',

            // Postgraduate
            'MA',
            'MSc',
            'MCom',
            'MCA',
            'MBA',
            'MTech',
            'ME',
            'MPharma',
            'MEd',
            'LLM',
            'MD',
            'MS',
            'MDS',

            // Professional / Certification
            'CA',
            'CS',
            'CMA',
            'CFA',
            'CPA',
            'PG Diploma',
            'Certificate Course',

            // Doctorate / Research
            'PhD',
            'MPhil',
            'Post Doctoral Fellowship',

            // Other
            'Vocational Course',
            'Skill Development Course',
            'Other',
        ];

        $data = [];

        foreach ($qualifications as $index => $name) {
            $data[] = [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => $name,
                'slug'       => Str::slug($name),
                'group'      => 'academic_qualification',
                'module'     => 'shared',
                'sort_order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('terms')->upsert(
            $data,
            ['slug', 'client_id'],
            ['status', 'updated_at']
        );
    }
}
