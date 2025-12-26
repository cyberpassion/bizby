<?php

namespace Modules\Shared\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Modules\Shared\Services\ListService;

abstract class SharedApiController extends Controller
{
	protected $listService;

    public function __construct(ListService $listService)
    {
        $this->listService = $listService;
    }

    /**
     * Return the model class for this controller
     */
    abstract protected function model();

    /**
     * Return validation rules for store/update
     */
    abstract protected function validationRules($id = null);

    /**
     * List resources
     */
    /*public function index()
    {
        $model = $this->model();
        $data = $model::paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Records fetched successfully.',
            'data' => $data
        ], Response::HTTP_OK);
    }*/

	public function index(Request $request)
	{
    	$model = $this->model();
    	$table = (new $model)->getTable();

	    // Convert GET params automatically into exact match filters
    	$whereFilters = $request->only(
        	(new $model)->getFillable()   // apply only valid DB columns
    	);

	    // Search param if exists
    	$search = $request->get('search', null);

		$searchable = property_exists($this, 'searchable') ? $this->searchable : [];

	    // Pass to ListService
    	$result = $this->listService->get($table, [
        	'where'          => $whereFilters,
        	'search'         => $search,
	        'searchColumns'  => $searchable,
    	    'sortBy'         => $request->get('sortBy', 'id'),
        	'sortDir'        => $request->get('sortDir', 'desc'),
	        'start'          => $request->get('start', 0),
    	    'limit'          => $request->get('limit', 20),
	    ]);

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Records fetched successfully.',
	        'data'    => $result
    	], Response::HTTP_OK);
	}

    /**
     * Show single resource
     */
    public function show($id)
    {
        $model = $this->model()::find($id);

        if (!$model) {
            return response()->json([
                'status' => 'error',
                'message' => 'Resource not found.',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Record fetched successfully.',
            'data' => $model
        ], Response::HTTP_OK);
    }

    /**
     * Store resource
     */
    public function store(Request $request)
    {
        //$validated = $request->validate($this->validationRules());
		$validated = $request->all();
        $model = $this->model();
        $resource = $model::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Record created successfully.',
            'data' => $resource
        ], Response::HTTP_CREATED);
    }

    /**
     * Update resource
     */
    public function update(Request $request, $id)
    {
        $modelInstance = $this->model()::find($id);

        if (!$modelInstance) {
            return response()->json([
                'status' => 'error',
                'message' => 'Resource not found.',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }

        // Only update fillable fields
        //$data = $request->only($modelInstance->getFillable());
		$data = $request->all();

        // Validate update rules
        $validator = Validator::make($data, $this->validationRules($id));

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
                'data' => null
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $modelInstance->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Record updated successfully.',
            'data' => $modelInstance
        ], Response::HTTP_OK);
    }

    /**
     * Delete resource
     */
    public function destroy($id)
    {
        $model = $this->model()::find($id);

        if (!$model) {
            return response()->json([
                'status' => 'error',
                'message' => 'Resource not found.',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }

        $model->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Resource deleted successfully.',
            'data' => null
        ], Response::HTTP_OK);
    }

/* ======================================================
 | STATS ENDPOINT (INSTRUCTION-DRIVEN, COUNT ONLY)
 | GET /{module}/stats
 |
 | Supports:
 | - metrics=total_records
 | - aggregates=count:gender=M,count:status=completed
 | - group_by=gender,status
 | - filters=gender:M,status:completed
 | - from=YYYY-MM-DD
 | - to=YYYY-MM-DD
 |
 | Defaults apply ONLY when no instructions are provided
 ====================================================== */
public function stats(Request $request)
{
    $model = $this->model();
    $query = $model::query();

    /* ------------------------------------
     | DATE FILTERS
     ------------------------------------ */
    if ($request->filled('from')) {
        $query->whereDate('created_at', '>=', $request->from);
    }

    if ($request->filled('to')) {
        $query->whereDate('created_at', '<=', $request->to);
    }

    /* ------------------------------------
     | GENERIC FILTERS
     | filters=gender:M,status:completed
     ------------------------------------ */
    if ($request->filled('filters')) {
        foreach (explode(',', $request->filters) as $filter) {
            [$key, $value] = array_pad(explode(':', $filter, 2), 2, null);
            if ($key && $value !== null) {
                $query->where($key, $value);
            }
        }
    }

    /* ------------------------------------
     | DETECT IF CLIENT SENT INSTRUCTIONS
     ------------------------------------ */
    $hasInstructions =
        $request->filled('metrics') ||
        $request->filled('aggregates') ||
        $request->filled('group_by');

    /* ------------------------------------
     | METRICS
     ------------------------------------ */
    $metricKeys = $hasInstructions
        ? array_filter(explode(',', $request->get('metrics', '')))
        : $this->defaultMetrics();

    $metrics = [];

    foreach ($metricKeys as $metric) {
        if ($metric === 'total_records') {
            $metrics['total_records'] = (clone $query)->count();
        }
    }

    /* ------------------------------------
     | AGGREGATES (Conditional counts)
     ------------------------------------ */
    $aggregateKeys = $hasInstructions
        ? array_filter(explode(',', $request->get('aggregates', '')))
        : $this->defaultAggregates();

    foreach ($aggregateKeys as $aggregate) {
        [$fn, $expr] = array_pad(explode(':', $aggregate, 2), 2, null);

        if ($fn === 'count' && $expr) {
            [$field, $value] = array_pad(explode('=', $expr, 2), 2, null);

            if ($field && $value !== null) {
                $metrics["count_{$field}_{$value}"] =
                    (clone $query)->where($field, $value)->count();
            }
        }
    }

    /* ------------------------------------
     | GROUPED STATS
     ------------------------------------ */
    $groupFields = $hasInstructions
        ? array_filter(explode(',', $request->get('group_by', '')))
        : $this->defaultGroups();

    $groups = [];

    foreach ($groupFields as $field) {
        if (!$this->isAllowedChart($field)) {
            continue;
        }

        $groups[$field] = (clone $query)
            ->select($field, DB::raw('COUNT(*) as total'))
            ->groupBy($field)
            ->pluck('total', $field)
            ->toArray();
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Stats generated successfully.',
        'data' => array_filter([
            'metrics' => $metrics ?: null,
            'groups'  => $groups  ?: null,
        ]),
    ], Response::HTTP_OK);
}

    /* ======================================================
 | GRAPHS ENDPOINT (INSTRUCTION-DRIVEN)
 | GET /{module}/graphs
 |
 | Supports:
 | - charts=gender,channel,status
 | - from=YYYY-MM-DD
 | - to=YYYY-MM-DD
 | Defaults:
 | - charts → allowedCharts()
 ====================================================== */
public function graphs(Request $request)
{
    $model = $this->model();
    $query = $model::query();

    /* ------------------------------------
     | DATE FILTERS
     ------------------------------------ */
    if ($request->filled('from')) {
        $query->whereDate('created_at', '>=', $request->from);
    }

    if ($request->filled('to')) {
        $query->whereDate('created_at', '<=', $request->to);
    }

    /* ------------------------------------
     | CHART FIELDS
     | Default → allowedCharts()
     ------------------------------------ */
    $chartFields = $request->filled('charts')
        ? array_filter(explode(',', $request->get('charts')))
        : $this->allowedCharts();

    $charts = [];

    foreach ($chartFields as $field) {
        if (!$this->isAllowedChart($field)) {
            continue;
        }

        $charts[$field] = $this->chartData($query, $field);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Graph data generated successfully.',
        'data' => [
            'charts' => $charts,
        ],
    ], Response::HTTP_OK);
}

    /* ======================================================
     | HELPERS
     ====================================================== */

    protected function chartData($query, string $field): array
    {
        return (clone $query)
            ->select($field, DB::raw('COUNT(*) as total'))
            ->groupBy($field)
            ->get()
            ->map(fn ($row) => [
                'label' => (string) $row->{$field},
                'value' => (int) $row->total,
            ])
            ->values()
            ->toArray();
    }

	 protected function allowedCharts(): array
    {
        return [];
    }

    protected function isAllowedChart(string $field): bool
    {
        $allowed = $this->allowedCharts();

        return empty($allowed) || in_array($field, $allowed, true);
    }

	protected function defaultMetrics(): array
	{
    	return ['total_records'];
	}

	protected function defaultAggregates(): array
	{
    	return [];
	}

	protected function defaultGroups(): array
	{
    	return [];
	}

}
