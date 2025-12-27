<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'message' => $this->faker->sentence(),
            'message_type' => 'text',

            'sender_id'   => 1,
            'sender_type' => 'Modules\\Student\\Models\\Student',

            'receiver_id'   => 1,
            'receiver_type' => 'Modules\\Shared\\Models\\User',

            'meta' => null,
            'read_at' => null,
        ];
    }
}
