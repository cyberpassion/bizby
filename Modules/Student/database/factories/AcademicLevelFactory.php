<?php

namespace Modules\Student\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Student\Models\AcademicLevel;

class AcademicLevelFactory extends Factory
{
    protected $model = AcademicLevel::class;

    public function definition()
    {
        return [
            'name' => 'Class ' . $this->faker->numberBetween(1,12),
            'short_name' => 'C' . $this->faker->numberBetween(1,12),
            'type' => 'class',
            'parent_id' => null,
            'order_no' => 1,
            'is_active' => 1
        ];
    }
}
