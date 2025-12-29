<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Cashflow\Models\Cashflow;

class CashflowFactory extends Factory
{
    protected $model = Cashflow::class;

    public function definition(): array
    {
        $direction = $this->faker->randomElement(['in', 'out']);

        return [
            'direction' => $direction,
            'amount'    => $this->faker->numberBetween(500, 50000),
            'currency'  => 'INR',

            'transaction_date' => $this->faker->date(),

            'category' => $this->faker->randomElement([
                'fee',
                'salary',
                'rent',
                'purchase',
                'donation',
            ]),

            'sub_category' => null,

            'payment_mode' => $this->faker->randomElement([
                'cash',
                'bank',
                'upi',
                'card',
            ]),

            'reference_no' => $this->faker->optional()->uuid(),

            // Polymorphic placeholders
            'party_id'   => null,
            'party_type' => null,

            'related_to_id'   => null,
            'related_to_type' => null,

            'description' => $this->faker->sentence(),
            'meta'        => null,
        ];
    }
}
