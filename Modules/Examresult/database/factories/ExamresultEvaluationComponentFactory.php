<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExamresultEvaluationComponentFactory extends Factory
{
    public function definition(): array
    {
        return [
            // evaluation_id will be injected from seeder

            'name' => $this->faker->randomElement([
                'Mathematics',
                'Physics',
                'Chemistry',
                'Section A',
                'Section B'
            ]),

            'code' => strtoupper($this->faker->lexify('COMP_??')),

            'max_score' => $this->faker->randomElement([50, 100]),

            'meta' => [
                'weightage' => 1,
                'type' => $this->faker->randomElement([
                    'theory',
                    'practical',
                    'objective'
                ]),
            ],
        ];
    }
}
