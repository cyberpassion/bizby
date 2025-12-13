<?php

namespace Modules\Student\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Student\Models\StudentOptionalFee;
use Modules\Student\Models\Student;
use Modules\Student\Models\StudentFeeHead;

class StudentOptionalFeeFactory extends Factory
{
    protected $model = StudentOptionalFee::class;

    public function definition()
    {
        static $used = [];

        $studentIds = Student::pluck('id')->toArray();
        $feeHeadIds = StudentFeeHead::pluck('id')->toArray();

        // Ensure both lists are not empty
        if (empty($studentIds) || empty($feeHeadIds)) {
            throw new \Exception("Students or Fee Heads not seeded before StudentOptionalFeeFactory.");
        }

        // Generate a unique combination
        do {
            $student = $this->faker->randomElement($studentIds);
            $feeHead = $this->faker->randomElement($feeHeadIds);
            $key = "{$student}-{$feeHead}";
        } while (isset($used[$key]));  // prevents duplicates

        $used[$key] = true;

        return [
            'student_id'   => $student,
            'fee_head_id'  => $feeHead,
            'academic_year'=> '2025-26',
            'is_active'    => 1,
        ];
    }
}
