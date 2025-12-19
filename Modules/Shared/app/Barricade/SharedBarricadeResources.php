<?php

namespace Modules\Shared\Barricade;

use Modules\Shared\Services\BarricadeResourceRegistry;
use Modules\Shared\Models\Term;

class SharedBarricadeResources
{
    public static function register(): void
    {
        /**
         * terms resource
         *
         * Used by multiple modules (student, employee, etc.)
         * Filter example:
         *  ['module' => 'student', 'group' => 'class']
         */
        BarricadeResourceRegistry::register(
            'terms',
            function (array $filter): bool {
                $query = Term::query();

                // Apply filters dynamically
                foreach ($filter as $column => $value) {
                    $query->where($column, $value);
                }

                return $query->exists();
            }
        );
    }
}
