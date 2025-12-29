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

            /* ---------- Primary & School Education ---------- */
            'Primary (Class 1–5)',
            'Upper Primary / Middle (Class 6–8)',
            'Secondary (Class 9–10)',
            'Senior Secondary (Class 11–12)',
            'Below 10th',
            '10th Pass',
            '12th Pass',

            /* ---------- Diploma / Certificate ---------- */
            'ITI',
            'Polytechnic Diploma',
            'Diploma in Engineering',
            'Diploma in Computer Applications',
            'Certificate Course',

            /* ---------- Undergraduate ---------- */
            'BA',
            'BSc',
            'BCom',
            'BBA',
            'BCA',
            'BE',
            'BTech',
            'BEd',
            'BPharma',
            'BArch',
            'BHM',
            'LLB',
            'BSW',

            /* ---------- Postgraduate ---------- */
            'MA',
            'MSc',
            'MCom',
            'MBA',
            'MCA',
            'ME',
            'MTech',
            'MEd',
            'MPharma',
            'MArch',
            'LLM',
            'MSW',

            /* ---------- Professional ---------- */
            'CA',
            'CS',
            'CMA',
            'ICWA',

            /* ---------- Medical ---------- */
            'MBBS',
            'BDS',
            'BAMS',
            'BHMS',
            'MD',
            'MS',
            'DM',

            /* ---------- Research ---------- */
            'MPhil',
            'PhD',
            'Post Doctorate',

            /* ---------- Other ---------- */
            'Vocational Training',
            'Skill Development Course'
        ];

        foreach ($qualifications as $index => $qualification) {
            DB::table('terms')->updateOrInsert(
                [
                    'slug'  => Str::slug($qualification),
                    'group' => 'qualifications',
                ],
                [
                    'client_id'  => 1,
                    'status'     => 1,
                    'name'       => $qualification,
                    'module'     => 'shared',
                    'sort_order' => $index + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}