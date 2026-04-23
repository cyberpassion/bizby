<?php

namespace Modules\Shared\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

use Modules\Shared\Services\ListService;
use Modules\Shared\Services\TermResolverService;

use Illuminate\Database\Eloquent\Relations\Relation;

use Illuminate\Support\Str;

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
		$module = Str::of(static::class)->after('Modules\\')->before('\\')->lower()->toString();
    	$model = $this->model();
    	$table = (new $model)->getTable();

	    // Convert GET params automatically into exact match filters
    	/*$whereFilters = $request->only(
        	(new $model)->getFillable()   // apply only valid DB columns
    	);*/
		$whereFilters = collect(
		    $request->only((new $model)->getFillable())
		)->filter(function ($value) {
    		return $value !== 'all' && $value !== null && $value !== '';
		})->toArray();

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

		/*
	    |--------------------------------------------------------------------------
    	| ADD STATUS LABEL FROM CONFIG
    	|--------------------------------------------------------------------------
	    */
    	//$statuses = app(LookupsApiController::class)->get('inventory')['statuses'];print_r($statuses);exit;

	    /*if (!empty($result['data'])) {
    	    $result['data'] = collect($result['data'])->map(function ($row) use ($statuses) {

        	    $row['status_label'] = $statuses[$row['status']] ?? $row['status'];

	            return $row;
    	    })->toArray();
    	}*/

		$lookupResponse = app(LookupsApiController::class)->get("{$module}.statuses");
		$statuses = $lookupResponse->getData(true)['data'] ?? [];

		if ($result instanceof \Illuminate\Pagination\LengthAwarePaginator) {

		    $result->setCollection(
        		$result->getCollection()->map(function ($row) use ($statuses) {

		            foreach ($row as $key => $value) {

        		        // ✅ Only process values like core_123 / tenant_456
                		if (is_string($value) && preg_match('/^(core|tenant)_\d+$/', $value)) {

		                    $resolved = \Modules\Shared\Services\TermResolverService::resolve($value);

        		            if ($resolved !== $value) {
                		        $row->{$key . '_label'} = $resolved;
                    		}
                		}
            		}

		            // ✅ Handle status separately
        		    if (isset($row->status)) {
                		$row->status_label = $statuses[$row->status] ?? $row->status;
            		}

					$row = $this->mergePolymorphicFields($row);

		            return $row;
        		})
    		);
		}

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
    	$module = Str::of(static::class)
	        ->after('Modules\\')
    	    ->before('\\')
        	->lower()
        	->toString();

	    $model = $this->model()::find($id);

	    if (!$model) {
    	    return response()->json([
        	    'status' => 'error',
            	'message' => 'Resource not found.',
            	'data' => null
	        ], Response::HTTP_NOT_FOUND);
    	}

	    // 🔥 Get statuses dynamically
    	$lookupResponse = app(LookupsApiController::class)->get("{$module}.statuses");
    	$statuses = $lookupResponse->getData(true)['data'] ?? [];

	    // 🔥 Convert model to object (safe handling)
    	$row = (object) $model->toArray();

	    // 🔥 Resolve term values
    	foreach ($row as $key => $value) {

	        if (is_string($value) && preg_match('/^(core|tenant)_\d+$/', $value)) {

	            $resolved = TermResolverService::resolve($value);

	            if ($resolved !== $value) {
    	            $row->{$key . '_label'} = $resolved;
        	    }
        	}
    	}

	    // 🔥 Status label
    	if (isset($row->status)) {
        	$row->status_label = $statuses[$row->status] ?? $row->status;
    	}

		$row = $this->mergePolymorphicFields($row);

	    return response()->json([
    	    'status' => 'success',
        	'message' => 'Record fetched successfully.',
        	'data' => $row
	    ], Response::HTTP_OK);
	}

    /**
     * Store resource
     */
    public function store(Request $request)
    {

		/*return response()->json([
		    'tenant_id'          => tenant('id'),
		    'tenant_db_config'   => tenant('tenancy_db_name'),          // canonical value
    		'active_connection'  => DB::getDefaultConnection(),  // mysql / central
		    'active_db_runtime'  => DB::connection()->getDatabaseName(), // runtime check
		]);*/

        //$validated = $request->validate($this->validationRules());
		//$validated = $request->all();
		$validated = $this->parsePolymorphicFields($request->all());
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
		//$data = $request->all();
		$data = $this->parsePolymorphicFields($request->all());

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
		if ($fn === 'sum' && $expr) {
		    $field = $expr;

		    if ($field) {
        		$metrics["sum_{$field}"] =
            		(clone $query)->sum($field);
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

	protected function parsePolymorphicFields(array $data): array
	{
    	$allowedTypes = array_keys(Relation::morphMap());

	    foreach ($data as $key => $value) {

	        if (
    	        is_string($value) &&
        	    preg_match('/^([a-zA-Z_]+):(\d+)$/', $value, $matches)
	        ) {
    	        $type = $matches[1];
        	    $id   = (int) $matches[2];

	            // ✅ Only allow known morph types
    	        if (!in_array($type, $allowedTypes, true)) {
        	        continue;
            	}

	            // 🔹 Case 1: key already ends with _id
    	        if (str_ends_with($key, '_id')) {
        	        $data[$key] = $id;
            	}

	            // 🔹 Case 2: normal field → convert to polymorphic
    	        else {
        	        $data[$key . '_type'] = $type;
            	    $data[$key . '_id']   = $id;

	                unset($data[$key]); // remove original
    	        }
        	}
    	}

	    return $data;
	}

	protected function mergePolymorphicFields($row)
	{
    	foreach ($row as $key => $value) {

	        if (str_ends_with($key, '_type')) {

	            $base = str_replace('_type', '', $key);
    	        $idKey = $base . '_id';

	            if (isset($row->$idKey)) {

	                $type = $row->$key;
    	            $id   = $row->$idKey;

	                if ($type && $id) {

	                    // ✅ value (employee:3)
    	                $row->$base = "{$type}:{$id}";

	                    // 🔥 ADD THIS (label from morphMap)
     	               $label = $this->resolvePolymorphicLabel($type, $id);

        	            if ($label) {
            	            $row->{$base . '_label'} = $label;
                	    }

	                    // optional cleanup (recommended)
    	                unset($row->$key, $row->$idKey);
        	        }
            	}
        	}
    	}

	    return $row;
	}

	protected function resolvePolymorphicLabel($type, $id)
	{
    	$map = Relation::morphMap();

	    if (!isset($map[$type])) {
    	    return null;
    	}

	    $modelClass = $map[$type];

	    return $modelClass::find($id)?->name ?? null;
	}

}
