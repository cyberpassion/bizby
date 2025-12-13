<?php

namespace Modules\Student\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Student\Models\StudentClassHistory;

class StudentClassHistoryFactory extends Factory
{
    protected $model = StudentClassHistory::class;

    public function definition()
    {
        return [
            'student_id' => 1,
            'academic_level_id' => 1,
            'academic_year' => '2025-26',
            'from_date' => now()->subYear(),
            'to_date' => now()
        ];
    }
}
