<?php

namespace Modules\Lead\Database\Factories;

use Modules\Lead\Models\LeadFollowup;
use Modules\Lead\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadFollowupFactory extends Factory
{
    protected $model = LeadFollowup::class;

    public function definition()
    {
        return [
            'lead_id'            => Lead::factory(),
            'contact_date'       => $this->faker->dateTimeBetween('-30 days', '+7 days'),
            'mode'               => $this->faker->randomElement([
                'call',
                'visit',
                'whatsapp',
                'email',
                'sms',
            ]),
            'reference_no'       => null,
            'response'           => $this->faker->optional()->sentence(6),
            'remark'             => $this->faker->optional()->paragraph(2),
            'next_followup_date' => $this->faker->optional()->date(),
        ];
    }
}
