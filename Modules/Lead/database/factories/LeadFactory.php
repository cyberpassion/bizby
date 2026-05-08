<?php

namespace Modules\Lead\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Modules\Lead\Models\Lead;

class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition(): array
    {
        return [

            'lead_code' =>
                'LEAD-' .
                $this->faker
                    ->unique()
                    ->numerify('#####'),

            'name' =>
                $this->faker->company(),

            'contact_person' =>
                $this->faker->name(),

            'mobile' =>
                $this->faker
                    ->numerify('9#########'),

            'email' =>
                $this->faker
                    ->companyEmail(),

            'district' =>
                $this->faker->city(),

            'state' =>
                $this->faker->state(),

            'pincode' =>
                $this->faker->postcode(),

            'website' =>
                $this->faker->url(),

            'generated_by_id' => null,
            'generated_by_type' => null,

            'assigned_to_id' => null,
            'assigned_to_type' => null,

            'category_id' => null,
            'source_id' => '',
            'stage_id' => null,

            'is_existing_client' =>
                $this->faker->boolean(20),

            'place' =>
                $this->faker->city(),

            'next_followup_date' =>
                $this->faker
                    ->optional()
                    ->date(),

            'lead_date' => now(),
        ];
    }
}