<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\Shared\Http\Controllers\SharedApiController;

use Modules\Student\Models\StudentFeeDiscount;

class StudentFeeDiscountApiController extends SharedApiController
{
    protected $searchable = [];
	protected $with = ['student','year','headTerm','classTerm','sectionTerm','pattern'];

    /*
    |--------------------------------------------------------------------------
    | Model
    |--------------------------------------------------------------------------
    */

    protected function model()
    {
        return StudentFeeDiscount::class;
    }

    /*
    |--------------------------------------------------------------------------
    | Validation Rules
    |--------------------------------------------------------------------------
    */

    protected function validationRules($id = null)
	{
    	return [

	        'head_term_id' => [
    	        'nullable',
        	    'integer',
            	'exists:terms,id',
	        ],

	        'pattern_id' => [
    	        'nullable',
        	    'integer',
            	'exists:student_fee_structure_patterns,id',
	        ],

	        'name' => [
    	        'required',
        	    'string',
	        ],

	        'amount' => [
    	        'nullable',
        	    'numeric',
            	'min:0',
	        ],

	        'percentage' => [
    	        'nullable',
        	    'numeric',
            	'min:0',
            	'max:100',
	        ],

	        'applicable_period_keys' => [
    	        'nullable',
        	    'array',
	        ],

	        'reason' => [
    	        'nullable',
        	    'string',
        	],
    	];
	}

    /*
    |--------------------------------------------------------------------------
    | Store Discount
    |--------------------------------------------------------------------------
    */

    public function storeCustom(
        Request $request,
        $studentId
    ) {

        $validated =
            $request->validate(
                $this->validationRules()
            );

        /*
        |--------------------------------------------------------------------------
        | Academic
        |--------------------------------------------------------------------------
        */

        $validated['student_id'] =
            $studentId;

        $validated['year_id'] =
            $request->year_id;

        /*
        |--------------------------------------------------------------------------
        | Duplicate Check
        |--------------------------------------------------------------------------
        */

        $exists =
		    StudentFeeDiscount::query()

		        ->where(
        		    'student_id',
		            $studentId
        		)

		        ->where(
         			'year_id',
		            $request->year_id
        		)

		        ->where(
        		    'head_term_id',
		            $request->head_term_id
        		)

		        ->exists();

        if ($exists) {

            return response()->json([

                'status' => 'error',

                'message' =>
                    'Discount already exists for this fee head.',
            ],

            Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /*
        |--------------------------------------------------------------------------
        | Create Discount
        |--------------------------------------------------------------------------
        */

        $discount =
            StudentFeeDiscount::create(
                $validated
            );

		app(
		    \Modules\Student\Services\RefreshStudentFeeDuesService::class
		)->handle(
    		$studentId,
    		$request->year_id
		);

        return response()->json([

            'status' => 'success',

            'message' =>
                'Discount added successfully.',

            'data' => $discount,

        ], Response::HTTP_CREATED);
    }

    /*
    |--------------------------------------------------------------------------
    | Student Discounts
    |--------------------------------------------------------------------------
    */

    public function showCustom(
    $studentId,
    $yearId
) {

    $data =
        StudentFeeDiscount::query()

            ->with([

                /*
                |--------------------------------------------------------------------------
                | Student
                |--------------------------------------------------------------------------
                */

                'student:id,name',

                /*
                |--------------------------------------------------------------------------
                | Head
                |--------------------------------------------------------------------------
                */

                'headTerm:id,name',

                /*
                |--------------------------------------------------------------------------
                | Pattern
                |--------------------------------------------------------------------------
                */

                'pattern:id,name',
            ])

            ->where(
                'student_id',
                $studentId
            )

            ->where(
                'year_id',
                $yearId
            )

            ->latest()

            ->get()

            ->map(function ($item) {

                return [

                    'id' =>
                        $item->id,

                    /*
                    |--------------------------------------------------------------------------
                    | Student
                    |--------------------------------------------------------------------------
                    */

                    'student_id' =>
                        $item->student_id,

                    'student_name' =>
                        $item->student?->name,

                    /*
                    |--------------------------------------------------------------------------
                    | Academic
                    |--------------------------------------------------------------------------
                    */

                    'year_id' =>
                        $item->year_id,

                    /*
                    |--------------------------------------------------------------------------
                    | Fee Head
                    |--------------------------------------------------------------------------
                    */

                    'head_term_id' =>
                        $item->head_term_id,

                    'head_name' =>
                        $item->head?->name,

                    /*
                    |--------------------------------------------------------------------------
                    | Pattern
                    |--------------------------------------------------------------------------
                    */

                    'pattern_id' =>
                        $item->pattern_id,

                    'pattern_name' =>
                        $item->pattern?->name,

                    /*
                    |--------------------------------------------------------------------------
                    | Discount
                    |--------------------------------------------------------------------------
                    */

                    'name' =>
                        $item->name,

                    'amount' =>
                        $item->amount,

                    'percentage' =>
                        $item->percentage,

                    /*
                    |--------------------------------------------------------------------------
                    | Period Scope
                    |--------------------------------------------------------------------------
                    */

                    'applicable_period_keys' =>

                        $item->applicable_period_keys
                        ?? [],

                    /*
                    |--------------------------------------------------------------------------
                    | Extra
                    |--------------------------------------------------------------------------
                    */

                    'reason' =>
                        $item->reason,

                    'created_at' =>
                        $item->created_at,
                ];
            });

    return response()->json([

        'status' => 'success',

        'data' => $data,

    ], Response::HTTP_OK);
}
}