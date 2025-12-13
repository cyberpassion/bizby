<?php

namespace Modules\Student\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Student\Models\Student;
use Modules\Student\Models\StudentFeeTransaction;

class StudentFeeTransactionFactory extends Factory
{
    protected $model = StudentFeeTransaction::class;

    public function definition()
    {
        return [
            'student_id' => Student::factory(),        // Creates a related student if not provided
            'amount' => $this->faker->numberBetween(200, 5000),
            'payment_mode' => $this->faker->randomElement(['cash', 'online', 'upi', 'cheque']),
            'reference' => $this->faker->uuid(),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
