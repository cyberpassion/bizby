<?php

namespace Modules\Student\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Student\Models\StudentOptionalFee;

class StudentOptionalFeeSeeder extends Seeder
{
    public function run()
    {
        // generate N records (change 50 to whatever)
        $items = StudentOptionalFee::factory()->count(50)->make();

        foreach ($items as $item) {
            StudentOptionalFee::firstOrCreate(
                [
                    'student_id'   => $item->student_id,
                    'fee_head_id'  => $item->fee_head_id,
                    'academic_year'=> $item->academic_year,
                ],
                [
                    'is_active'    => $item->is_active,
                ]
            );
        }
    }
}
