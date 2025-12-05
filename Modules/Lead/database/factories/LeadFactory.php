<?php

namespace Modules\Lead\Database\Factories;

use Modules\Lead\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition()
    {
        return [
            'lead_code' => 'LEAD-' . now()->format('Ymd') . '-' . fake()->unique()->randomNumber(4),

            'name'              => $this->faker->company(),
            'contact_person'    => $this->faker->name(),
            'mobile'            => $this->faker->phoneNumber(),
            'email'             => $this->faker->safeEmail(),

            'district'          => $this->faker->city(),
            'state'             => $this->faker->state(),
            'pincode'           => $this->faker->postcode(),
            'website'           => $this->faker->domainName(),

            'is_existing_client' => $this->faker->boolean(20),
            'next_followup_date' => $this->faker->optional()->date(),
        ];
    }
}
