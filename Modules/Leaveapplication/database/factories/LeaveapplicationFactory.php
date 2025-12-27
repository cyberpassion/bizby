<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LeaveapplicationFactory extends Factory
{
    protected $model = \Modules\Leaveapplication\Models\Leaveapplication::class;

    public function definition(): array
    {
        return [
            'entity_id'   => 1,
            'entity_type' => 'Modules\\Student\\Models\\Student',

            'start_date' => $this->faker->date(),
            'end_date'   => $this->faker->date(),

            'type' => $this->faker->randomElement([
                'full_day',
                'half_day',
                'session',
            ]),

            'session_ref' => $this->faker->optional()->randomElement([
                'Morning',
                'Afternoon',
                'Period 2',
            ]),

            'leave_code' => $this->faker->randomElement([
                'casual',
                'sick',
                'paid',
                'unpaid',
            ]),

            'reason' => $this->faker->sentence(),

            'approval_status' => $this->faker->randomElement([
                'pending',
                'approved',
                'rejected',
            ]),

            'approved_at' => null,
            'affects_attendance' => true,
        ];
    }
}
