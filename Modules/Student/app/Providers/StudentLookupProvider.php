<?php

namespace Modules\Student\Providers;

use Modules\Shared\Services\LookupRegistry;
use Modules\Student\Models\StudentAcademicYear;

class StudentLookupProvider
{
    public function register()
    {
        LookupRegistry::register(
            'student.academic-years',
            fn () => StudentAcademicYear::orderByDesc('start_year')
                ->get()
                ->mapWithKeys(fn ($year) => [
                    $year->id => $year->name
                ])
                ->toArray()
        );
    }
}
