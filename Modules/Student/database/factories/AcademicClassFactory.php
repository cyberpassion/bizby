<?php

namespace Modules\Student\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Student\Models\AcademicClass;
use Modules\Student\Models\AcademicLevel;

class AcademicClassFactory extends Factory
{
    protected $model = AcademicClass::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word . ' Class',
            'academic_level_id' => AcademicLevel::factory(),
            'section' => $this->faker->randomElement(['A','B','C']),
        ];
    }
}
