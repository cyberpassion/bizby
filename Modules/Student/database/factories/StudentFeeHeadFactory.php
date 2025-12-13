<?php

namespace Modules\Student\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Student\Models\StudentFeeHead;

class StudentFeeHeadFactory extends Factory
{
    protected $model = StudentFeeHead::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Tuition Fee','Transport','Hostel','Exam Fee']),
            'frequency' => $this->faker->randomElement(['monthly','quarterly','yearly','one_time']),
            'default_amount' => $this->faker->numberBetween(500,5000),
            'is_active' => 1
        ];
    }
}
