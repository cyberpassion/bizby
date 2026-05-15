<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;

use Modules\Shared\Http\Controllers\SharedApiController;

use Modules\Student\Models\StudentFeeDue;

class StudentFeeDueApiController1 extends SharedApiController
{
    protected $searchable = [];

    /*
    |--------------------------------------------------------------------------
    | Model
    |--------------------------------------------------------------------------
    */

    protected function model()
    {
        return StudentFeeDue::class;
    }

    /*
    |--------------------------------------------------------------------------
    | Validation Rules
    |--------------------------------------------------------------------------
    */

    protected function validationRules($id = null)
    {
        return [

            'student_id' => [
                'required',
                'exists:students,id',
            ],

            'year_id' => [
                'required',
                'exists:student_academic_years,id',
            ],

            'class_term_id' => [
                'required',
                'exists:terms,id',
            ],

            'section_term_id' => [
                'required',
                'exists:terms,id',
            ],

            'fee_structure_id' => [
                'nullable',
                'exists:student_fee_structures,id',
            ],

            'due_type' => [
                'required',
                'in:fee,carry_forward,adjustment',
            ],

            'period' => [
                'nullable',
                'string',
            ],

            'total_amount' => [
                'required',
                'numeric',
            ],

            'discount_amount' => [
                'nullable',
                'numeric',
            ],

            'paid_amount' => [
                'nullable',
                'numeric',
            ],

            'due_amount' => [
                'required',
                'numeric',
            ],

            'source_year_id' => [
                'nullable',
                'exists:student_academic_years,id',
            ],

            'meta' => [
                'nullable',
                'array',
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Store Due
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate(
            $this->validationRules()
        );

        $due = StudentFeeDue::create($validated);

        return response()->json([

            'status' => 'success',

            'message' => 'Fee due created successfully',

            'data' => $due,

        ], Response::HTTP_CREATED);
    }

    /*
    |--------------------------------------------------------------------------
    | Student Dues
    |--------------------------------------------------------------------------
    */

    public function studentDues(int $studentId)
    {
        $data = StudentFeeDue::query()

            ->with([
                'year:id,name',
                'feeStructure:id,head_term_id',
            ])

            ->where('student_id', $studentId)

            ->latest()

            ->get();

        return response()->json([

            'status' => 'success',

            'data' => $data,

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Carry Forward
    |--------------------------------------------------------------------------
    */

    public function carryForward(
        Request $request,
        int $studentId
    ) {

        $validated = $request->validate([

            'source_year_id' => [
                'required',
                'exists:student_academic_years,id',
            ],

            'target_year_id' => [
                'required',
                'exists:student_academic_years,id',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:1',
            ],

            'class_term_id' => [
                'required',
                'exists:terms,id',
            ],

            'section_term_id' => [
                'required',
                'exists:terms,id',
            ],
        ]);

        $due = StudentFeeDue::create([

            'student_id' => $studentId,

            'year_id' => $validated['target_year_id'],

            'class_term_id' =>
                $validated['class_term_id'],

            'section_term_id' =>
                $validated['section_term_id'],

            'due_type' => 'carry_forward',

            'total_amount' =>
                $validated['amount'],

            'discount_amount' => 0,

            'paid_amount' => 0,

            'due_amount' =>
                $validated['amount'],

            'source_year_id' =>
                $validated['source_year_id'],

            'meta' => [

                'reason' =>
                    'Previous year carry forward',
            ],
        ]);

        return response()->json([

            'status' => 'success',

            'message' =>
                'Carry forward created successfully',

            'data' => $due,

        ], Response::HTTP_CREATED);
    }
}