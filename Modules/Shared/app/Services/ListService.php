<?php

namespace Modules\Shared\Services;

use Illuminate\Support\Facades\DB;

class ListService
{
    /**
     * Universal List Fetcher
     */
    public function get(string $table, array $options = [])
    {
        $query = DB::table($table);

        // 1. Select specific columns (optional)
        if (!empty($options['select'])) {
            $query->select($options['select']);
        }

        // 2. Exact match filters
        if (!empty($options['where'])) {
            foreach ($options['where'] as $column => $value) {
                if ($value !== null && $value !== '') {
                    $query->where($column, $value);
                }
            }
        }

        // 3. whereIn filters
        if (!empty($options['whereIn'])) {
            foreach ($options['whereIn'] as $column => $values) {
                $query->whereIn($column, $values);
            }
        }

        // 4. LIKE search (multi-column)
        if (!empty($options['search']) && !empty($options['searchColumns'])) {
            $query->where(function ($q) use ($options) {
                foreach ($options['searchColumns'] as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $options['search'] . '%');
                }
            });
        }

        // 5. Date range filter
        if (!empty($options['dateColumn']) && !empty($options['from']) && !empty($options['to'])) {
            $query->whereBetween($options['dateColumn'], [
                $options['from'],
                $options['to']
            ]);
        }

        // 6. Join tables
        if (!empty($options['joins'])) {
            foreach ($options['joins'] as $join) {
                $query->join(
                    $join['table'],
                    $join['localKey'],
                    '=',
                    $join['foreignKey']
                );
            }
        }

        // 7. Sorting
        $query->orderBy(
            $options['sortBy'] ?? 'id',
            $options['sortDir'] ?? 'desc'
        );

        // 8. Pagination using start & limit
        $start = $options['start'] ?? 0;
        $limit = $options['limit'] ?? 20;

        $query->offset($start)->limit($limit);

        // 9. Return both list + total count
        return [
            'total' => $this->count($table, $options),
            'list'  => $query->get()
        ];
    }

    /**
     * Count total with same filters (for pagination)
     */
    public function count(string $table, array $options = [])
    {
        $query = DB::table($table);

        // apply same filters (except pagination)
        if (!empty($options['where'])) {
            foreach ($options['where'] as $column => $value) {
                if ($value !== null && $value !== '') {
                    $query->where($column, $value);
                }
            }
        }

        if (!empty($options['whereIn'])) {
            foreach ($options['whereIn'] as $column => $values) {
                $query->whereIn($column, $values);
            }
        }

        if (!empty($options['search']) && !empty($options['searchColumns'])) {
            $query->where(function ($q) use ($options) {
                foreach ($options['searchColumns'] as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $options['search'] . '%');
                }
            });
        }

        if (!empty($options['dateColumn']) && !empty($options['from']) && !empty($options['to'])) {
            $query->whereBetween($options['dateColumn'], [$options['from'], $options['to']]);
        }

        return $query->count();
    }
}
