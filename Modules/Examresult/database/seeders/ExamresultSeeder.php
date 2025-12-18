<?php

namespace Modules\Examresult\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamresultSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('examresults')->insert([
            [
                // ===== commonSaasFields =====
                'client_id'           => 1,
                'status'              => 1,
                'created_by'          => 1,
                'updated_by'          => 1,
                'created_at'          => now(),
                'updated_at'          => now(),
                'entry_source'        => 'system',
                'entry_source_ref_id' => null,
                'remark'              => 'Initial exam result seed',
                'system_remark'       => 'Seeder generated exam result',
                'meta_info'           => json_encode([
                    'seed' => true,
                    'module' => 'examresult'
                ]),

                // ===== exam result fields =====
                'exam_session'            => '2024-2025',
                'exam_name'               => 'Mid Term Examination',
                'exam_class'              => 'Class 10',
                'exam_section'            => 'A',
                'exam_type'               => 'Written',
                'examinee_id_type'        => 'Roll Number',
                'announcement_datetime'   => '2025-01-15 10:00:00',
                'exam_options'            => json_encode([
                    'grading' => 'Marks',
                    'max_marks' => 100,
                    'passing_marks' => 33
                ]),
            ],
            [
                'client_id'           => 1,
                'status'              => 1,
                'created_by'          => 1,
                'updated_by'          => 1,
                'created_at'          => now(),
                'updated_at'          => now(),
                'entry_source'        => 'system',
                'entry_source_ref_id' => null,
                'remark'              => 'Annual exam seed',
                'system_remark'       => 'Seeder generated exam result',
                'meta_info'           => json_encode([
                    'seed' => true,
                    'module' => 'examresult'
                ]),

                'exam_session'            => '2024-2025',
                'exam_name'               => 'Annual Examination',
                'exam_class'              => 'Class 12',
                'exam_section'            => 'Science',
                'exam_type'               => 'Board',
                'examinee_id_type'        => 'Registration Number',
                'announcement_datetime'   => '2025-03-25 09:30:00',
                'exam_options'            => json_encode([
                    'grading' => 'Grade',
                    'scale' => 'A+ to F'
                ]),
            ],
        ]);
    }
}
