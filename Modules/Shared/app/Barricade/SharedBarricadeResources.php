<?php

namespace Modules\Shared\Barricade;

use Modules\Shared\Services\BarricadeResourceRegistry;
use Modules\Shared\Models\Term;

use Modules\Employee\Models\Employee;
use Modules\Student\Models\Student;

class SharedBarricadeResources
{
    public static function register(): void
    {
        self::registerResource('terms', Term::class);
        self::registerResource('employees', Employee::class);
        self::registerResource('students', Student::class);
    }

    protected static function registerResource(string $resource, string $modelClass): void
    {
        BarricadeResourceRegistry::register(
            $resource,
            function (array $filter) use ($modelClass): bool {
                $query = $modelClass::query();

                foreach ($filter as $column => $value) {
                    $query->where($column, $value);
                }

                return $query->exists();
            }
        );
    }
}
