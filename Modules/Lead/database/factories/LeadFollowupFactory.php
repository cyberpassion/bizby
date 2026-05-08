<?php

namespace Modules\Lead\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Modules\Lead\Models\LeadFollowup;

class LeadFollowupFactory extends Factory
{
    protected $model =
        LeadFollowup::class;

    public function definition(): array
    {
        return [

            'contact_date' =>
                $this->faker
                    ->dateTimeBetween(
                        '-30 days',
                        'now'
                    ),

            'mode' =>
                $this->faker
                    ->randomElement([
                        'call',
                        'visit',
                        'whatsapp',
                        'email',
                        'sms'
                    ]),

            'reference_no' =>
                $this->faker
                    ->optional()
                    ->uuid(),

            'response' =>
                $this->faker
                    ->sentence(),

            'remark' =>
                $this->faker
                    ->optional()
                    ->paragraph(),

            'next_followup_date' =>
                $this->faker
                    ->optional()
                    ->date(),

            'contact_by_id' => null,
            'contact_by_type' => null,

            'tenant_id' => 1,

            'created_by' => null,
            'updated_by' => null,
            'deleted_by' => null,
        ];
    }
}