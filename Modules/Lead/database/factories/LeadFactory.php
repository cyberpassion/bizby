<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LeadFactory extends Factory
{
    public function definition(): array
    {
        return [
            'lead_code' => 'LEAD-' . $this->faker->unique()->numerify('#####'),

            'name' => $this->faker->company(),
            'contact_person' => $this->faker->name(),

            'mobile' => $this->faker->numerify('9#########'),
            'email' => $this->faker->companyEmail(),

            'district' => $this->faker->city(),
            'state' => $this->faker->state(),
            'pincode' => $this->faker->postcode(),

            'website' => $this->faker->url(),

            // Morphs (keep null for generic test data)
            'generated_by_id' => null,
            'generated_by_type' => null,

            'assigned_to_id' => null,
            'assigned_to_type' => null,

            // Terms (can be wired later)
            'category_id' => null,
            'source_id' => null,
            'stage_id' => null,

            'is_existing_client' => $this->faker->boolean(20),
            'place' => $this->faker->city(),

            'next_followup_date' => $this->faker->optional()->date(),

            'thread_parent_id' => null,
        ];
    }
}
