<?php

namespace Modules\Shared\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ListService
{
    /**
     * Universal List Fetcher
     */
    public function get(string $table, array $options = [])
	{
    	$query = DB::table($table);

	    // (KEEP ALL YOUR LOGIC EXACTLY AS IT IS)

	    if (!empty($options['select'])) {
    	    $query->select($options['select']);
    	}

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

	    $query->orderBy(
    	    $options['sortBy'] ?? 'id',
        	$options['sortDir'] ?? 'desc'
	    );

	    // START + LIMIT (OFFSET & LIMIT)
    	$start = $options['start'] ?? 0;
    	$limit = $options['limit'] ?? 20;

	    $total = $this->count($table, $options);
    	$items = $query->offset($start)->limit($limit)->get();

	    // Convert start into proper page number
    	$page = floor($start / $limit) + 1;

	    // CREATE PAGINATOR RESPONSE
    	$paginator = new LengthAwarePaginator(
        	$items,
	        $total,
    	    $limit,
        	$page,
        	['path' => request()->url(), 'query' => request()->query()]
    	);

	    return $paginator;
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
