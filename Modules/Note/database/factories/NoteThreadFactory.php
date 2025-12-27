<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NoteThreadFactory extends Factory
{
    public function definition(): array
    {
        return [
            'type'    => $this->faker->randomElement(['support', 'internal', 'chat']),
            'subject' => $this->faker->sentence(4),

            'participant_one_id'   => 1,
            'participant_one_type' => 'Modules\\Student\\Models\\Student',

            'participant_two_id'   => 1,
            'participant_two_type' => 'Modules\\Shared\\Models\\User',

            'last_message_at' => now(),
        ];
    }
}
