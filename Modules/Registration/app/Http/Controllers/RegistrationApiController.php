<?php

namespace Modules\Registration\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Registration\Models\Registration;
use Modules\Shared\Http\Controllers\SharedApiController;
use Carbon\Carbon;
use Modules\Registration\Models\RegistrationCycle;

class RegistrationApiController extends SharedApiController
{
	protected $with = ['steps','documents','payments'];

    protected function model()
    {
        return Registration::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'type' => 'required|string',
            'registration_status' => 'nullable|string',
        ];
    }

    /**
     * Charts available
     */
    protected function allowedCharts(): array
    {
        return [
            'registration_status',
            'type',
        ];
    }

    /**
     * Default KPI metrics
     */
    protected function defaultMetrics(): array
    {
        return [
            'total_records',
            'submitted_records',
            'draft_records',
            'new_this_month',
        ];
    }

    /**
     * Aggregates (cards)
     */
    protected function defaultAggregates(): array
    {
        return [
            'count:registration_status=draft',
            'count:registration_status=submitted',
        ];
    }

    /**
     * Grouping (charts)
     */
    protected function defaultGroups(): array
    {
        return [
            'registration_status',
            'type',
        ];
    }

    /**
     * Extra custom stats
     */
    public function extraStats()
    {
        return [
            'total_registrations' => Registration::count(),

            'draft_registrations' => Registration::where('registration_status', 'draft')->count(),

            'submitted_registrations' => Registration::where('registration_status', 'submitted')->count(),

            'recent_registrations' => Registration::whereMonth('created_at', now()->month)->count(),

            // Optional if you later add payments
            // 'total_revenue' => Registration::sum('amount'),
        ];
    }

    /**
     * Custom create (override default store if needed)
     */
    public function create(Request $request)
	{
    	$cycle = \Modules\Registration\Models\RegistrationCycle::findOrFail($request->registration_cycle_id);

	    return Registration::create([
    	    'user_id' => $request->user()->id,
        	'registration_cycle_id' => $cycle->id,
	        'registration_status' => 'draft',
    	]);
	}

	public function createMyRegistration(Request $request)
	{
    	$cycle = \Modules\Registration\Models\RegistrationCycle::findOrFail($request->registration_cycle_id);

	    return Registration::create([
    	    'user_id' => auth()->id(),
        	'registration_cycle_id' => $cycle->id,
	        'registration_status' => 'draft',
    	]);
	}

    public function my()
    {
        $response = Registration::where('user_id', auth()->id())
            ->with('cycle', 'steps', 'documents', 'payments')
            ->latest()
            ->get();
		return response()->json([
    	    'status' => 'success',
        	'message' => 'Registrations fetched successfully.',
	        'data' => $response
    	]);
    }

	public function myCycle(int $cycleId)
	{
    	$registration = Registration::where('user_id', auth()->id())
	        ->where('registration_cycle_id', $cycleId)
    	    ->with('steps') // important
        	->first();

	    return response()->json([
    	    'status' => 'success',
        	'data' => $registration
	    ]);
	}

    public function submit(int $id)
    {
        $reg = Registration::findOrFail($id);

        $reg->update([
            'registration_status' => 'submitted',
            'submitted_at' => now()
        ]);

        return $reg;
    }

	public function activeCycles()
	{
    	$today = Carbon::today();

	    $cycles = RegistrationCycle::where('status', '1') // active status
    	    ->where(function ($q) use ($today) {
	            $q->whereNull('start_date')
    	          ->orWhere('start_date', '<=', $today);
        	})
	        ->where(function ($q) use ($today) {
    	        $q->whereNull('end_date')
        	      ->orWhere('end_date', '>=', $today);
	        })
    	    ->with('type:id,name,code')
        	->get();

	    return response()->json([
    	    'status' => 'success',
        	'message' => 'Active registration cycles fetched successfully.',
	        'data' => $cycles
    	]);
	}

	public function availableForMe()
	{
    	$userId = auth()->id();
	    $today = Carbon::today();

	    $cycles = RegistrationCycle::where('status', '1')
    	    ->where(function ($q) use ($today) {
        	    $q->whereNull('start_date')
            	  ->orWhere('start_date', '<=', $today);
	        })
    	    ->where(function ($q) use ($today) {
        	    $q->whereNull('end_date')
            	  ->orWhere('end_date', '>=', $today);
	        })
    	    ->whereDoesntHave('registrations', function ($q) use ($userId) {
        	    $q->where('user_id', $userId); // or completed
	        })
    	    ->with('type:id,name,code')
        	->get();

	    return response()->json([
    	    'status' => 'success',
        	'message' => 'Available registration cycles for user.',
        	'data' => $cycles
	    ]);
	}

	public function flow(int $cycleId)
	{
    	$cycle = \Modules\Registration\Models\RegistrationCycle::with([
	        'type:id,name,code',
    	    'type.steps' => function ($q) {
        	    $q->orderBy('step_order');
        	}
	    ])->findOrFail($cycleId);

	    return response()->json([
    	    'status' => 'success',
        	'message' => 'Registration flow fetched successfully.',
	        'data' => [
    	        'cycle' => [
        	        'id' => $cycle->id,
            	    'name' => $cycle->name,
	            ],
    	        'type' => $cycle->type,
        	    'steps' => $cycle->type->steps
	        ]
    	]);
	}

}