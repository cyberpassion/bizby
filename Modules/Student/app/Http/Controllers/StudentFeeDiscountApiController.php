<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;

use Modules\Shared\Http\Controllers\SharedApiController;

use Modules\Student\Models\StudentFeeDiscount;

class StudentFeeDiscountApiController extends SharedApiController
{
    protected $searchable = [];

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

			'student_fee_structure_id' => [
	            'nullable',
    	        'integer',
        	],

            'name' => [
                'required',
                'string',
            ],

            'amount' => [
                'nullable',
                'numeric',
            ],

            'percentage' => [
                'nullable',
                'numeric',
            ],

            'applicable_periods' => [
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
    | Create Discount
    |--------------------------------------------------------------------------
    |
    | POST /students/{id}/fee-discounts
    |
    */

    public function storeCustom(Request $request, $id)
    {
        $validated = $request->validate(
            $this->validationRules()
        );

        $validated['student_id'] = $id;

        $validated['year_id'] =
            $request->year_id;

		$exists = StudentFeeDiscount::query()

		    ->where('student_id', $id)

		    ->where('year_id', $request->year_id)

		    ->where(
		        'student_fee_structure_id',
        		$request->student_fee_structure_id
    		)

		    ->exists();

		if ($exists) {
		    return response()->json([
		        'status' => 'error',
		        'message' => 'Discount already exists for this fee head.',
		    ], Response::HTTP_UNPROCESSABLE_ENTITY);
		}

        $discount = StudentFeeDiscount::create(
            $validated
        );

        return response()->json([

            'status' => 'success',

            'message' =>
                'Discount added successfully',

            'data' => $discount,

        ], Response::HTTP_CREATED);
    }

    /*
    |--------------------------------------------------------------------------
    | Get Student Discounts By Year
    |--------------------------------------------------------------------------
    |
    | GET /students/{studentId}/fee-discounts/{yearId}
    |
    */

    public function showCustom(
        $studentId,
        $yearId
    ) {

        $data = StudentFeeDiscount::query()

            ->where('student_id', $studentId)

            ->where('year_id', $yearId)

            ->latest()

            ->get();

        return response()->json([

            'status' => 'success',

            'data' => $data,

        ], Response::HTTP_OK);
    }
}