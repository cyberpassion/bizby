<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller;

use Illuminate\Http\Response;

use Modules\Student\Models\StudentFeeStructurePattern;

class StudentFeeStructurePatternApiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | List
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $patterns = StudentFeeStructurePattern::query()

            ->with([
                'periods:id,pattern_id,key,label,sort_order'
            ])

            ->where('is_active', true)

            ->orderBy('sort_order')

            ->get();

        return response()->json([

            'status' => 'success',

            'data' => ['data' => $patterns],
        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Show
    |--------------------------------------------------------------------------
    */

    public function show(int $id)
    {
        $pattern = StudentFeeStructurePattern::query()

            ->with([
                'periods:id,pattern_id,key,label,sort_order'
            ])

            ->findOrFail($id);

        return response()->json([

            'status' => 'success',

            'data' => $pattern,
        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'key' => [
                'required',
                'string',
                'max:255',
                'unique:student_fee_structure_patterns,key',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'is_customizable' => [
                'nullable',
                'boolean',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
            ],

            'periods' => [
                'required',
                'array',
                'min:1',
            ],

            'periods.*.key' => [
                'required',
                'string',
            ],

            'periods.*.label' => [
                'required',
                'string',
            ],

            'periods.*.sort_order' => [
                'nullable',
                'integer',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Pattern
        |--------------------------------------------------------------------------
        */

        $pattern = StudentFeeStructurePattern::create([

            'name' => $validated['name'],

            'key' => $validated['key'],

            'description' =>
                $validated['description'] ?? null,

            'is_customizable' =>
                $validated['is_customizable'] ?? false,

            'is_active' =>
                $validated['is_active'] ?? true,

            'sort_order' =>
                $validated['sort_order'] ?? 0,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Periods
        |--------------------------------------------------------------------------
        */

        foreach ($validated['periods'] as $period) {

            $pattern->periods()->create([

                'key' => $period['key'],

                'label' => $period['label'],

                'sort_order' =>
                    $period['sort_order'] ?? 0,

                'is_active' => true,
            ]);
        }

        return response()->json([

            'status' => 'success',

            'message' =>
                'Fee structure pattern created successfully',

            'data' => $pattern->load('periods'),
        ], Response::HTTP_CREATED);
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
        int $id,
        Request $request
    ) {
        $pattern = StudentFeeStructurePattern::findOrFail($id);

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'key' => [
                'required',
                'string',
                'max:255',
                'unique:student_fee_structure_patterns,key,' . $pattern->id,
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'is_customizable' => [
                'nullable',
                'boolean',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
            ],

            'periods' => [
                'required',
                'array',
                'min:1',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Update Pattern
        |--------------------------------------------------------------------------
        */

        $pattern->update([

            'name' => $validated['name'],

            'key' => $validated['key'],

            'description' =>
                $validated['description'] ?? null,

            'is_customizable' =>
                $validated['is_customizable'] ?? false,

            'is_active' =>
                $validated['is_active'] ?? true,

            'sort_order' =>
                $validated['sort_order'] ?? 0,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Replace Periods
        |--------------------------------------------------------------------------
        */

        $pattern->periods()->delete();

        foreach ($validated['periods'] as $period) {

            $pattern->periods()->create([

                'key' => $period['key'],

                'label' => $period['label'],

                'sort_order' =>
                    $period['sort_order'] ?? 0,

                'is_active' => true,
            ]);
        }

        return response()->json([

            'status' => 'success',

            'message' =>
                'Fee structure pattern updated successfully',

            'data' => $pattern->load('periods'),
        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function destroy(int $id)
    {
        $pattern = StudentFeeStructurePattern::findOrFail($id);

        $pattern->delete();

        return response()->json([

            'status' => 'success',

            'message' =>
                'Fee structure pattern deleted successfully',
        ], Response::HTTP_OK);
    }

	public function periods(int $id)
	{
    	$periods = StudentFeeStructurePattern::query()

	        ->with([
    	        'periods:id,pattern_id,key,label,sort_order'
        	])

	        ->findOrFail($id)

	        ->periods;

	    return response()->json([

	        'status' => 'success',

	        'data' => $periods,
    	]);
	}
}