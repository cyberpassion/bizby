<?php

namespace Modules\Student\Barricade;

use Modules\Shared\Services\BarricadeResourceRegistry;
use Modules\Student\Models\StudentAcademicYear;

class StudentBarricadeResources
{
    public static function register(): void
    {
        BarricadeResourceRegistry::register(
            'academic_years',
            fn (array $filter) =>
                StudentAcademicYear::where($filter)->exists()
        );
    }
}
