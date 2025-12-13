<?php

namespace Modules\Student\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Student\Models\StudentFee;

class StudentFeeFactory extends Factory
{
    protected $model = StudentFee::class;

    public function definition()
	{
    	$studentIds = \Modules\Student\Models\Student::pluck('id')->toArray();
    	$feeHeadIds = \Modules\Student\Models\StudentFeeHead::pluck('id')->toArray();

	    return [
    	    'student_id' => $this->faker->randomElement($studentIds),
        	'fee_head_id' => $this->faker->randomElement($feeHeadIds),
        	'academic_year' => '2025-26',

	        'period_code' => $this->faker->unique()->numerify('2025-##'),
    	    'period_label' => "Period " . $this->faker->unique()->numberBetween(1, 99),

	        'payable' => $this->faker->numberBetween(500,5000),
    	    'concession' => 0,
        	'is_active' => 1
    	];
	}

}
