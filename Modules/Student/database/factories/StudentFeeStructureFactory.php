<?php

namespace Modules\Student\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Student\Models\StudentFeeStructure;

class StudentFeeStructureFactory extends Factory
{
    protected $model = StudentFeeStructure::class;

    public function definition()
    {
        return [
            'academic_level_id' => 1,
            'fee_head_id' => 1,
            'academic_year' => '2025-26',
            'frequency' => 'monthly',
            'amount' => $this->faker->numberBetween(500,5000)
        ];
    }
}
