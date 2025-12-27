<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExamresultEvaluationFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Common SaaS fields handled by commonSaasFields()
            'name' => $this->faker->randomElement([
                'Unit Test 1',
                'Unit Test 2',
                'Mid Term',
                'Final Exam',
                'Mock Test'
            ]),

            'type' => $this->faker->randomElement([
                'exam',
                'test',
                'assessment'
            ]),

            // Used for annual / combined reports
            'group_code' => $this->faker->randomElement([
                '2024_ANNUAL',
                'SEM_1',
                'TERM_1'
            ]),

            'sequence' => $this->faker->numberBetween(1, 10),

            'evaluation_date' => $this->faker->date(),

            'meta' => [
                'weightage' => $this->faker->randomElement([20, 30, 50, 100]),
                'passing_score' => 40
            ],
        ];
    }
}
