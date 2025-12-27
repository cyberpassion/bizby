<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExamresultEvaluationResultFactory extends Factory
{
    public function definition(): array
    {
        $maxScore = $this->faker->randomElement([50, 100]);
        $score = $this->faker->numberBetween(0, $maxScore);

        return [
            // evaluation_id injected by seeder
            // evaluation_component_id injected by seeder

            // Polymorphic entity (kept generic)
            'entity_id' => $this->faker->numberBetween(1, 50),
            'entity_type' => 'Modules\\Student\\Models\\Student',

            'score' => $score,
            'max_score' => $maxScore,

            'grade' => match (true) {
                $score >= 85 => 'A',
                $score >= 70 => 'B',
                $score >= 50 => 'C',
                default      => 'D',
            },

            'status' => $score >= 40 ? 'pass' : 'fail',

            'remark' => $this->faker->optional()->sentence(),
        ];
    }
}
