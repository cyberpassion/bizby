<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\Shared\Http\Controllers\SharedApiController;

use Modules\Student\Models\StudentFeeStructure;
use Modules\Student\Models\StudentFeeStructureOverride;

class StudentFeeStructureOverrideApiController extends SharedApiController
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
        return StudentFeeStructureOverride::class;
    }

    /*
    |--------------------------------------------------------------------------
    | Validation Rules
    |--------------------------------------------------------------------------
    */

    protected function validationRules($id = null)
    {
        return [

            'structures' => [
                'required',
                'array',
                'min:1',
            ],

            /*
            |--------------------------------------------------------------------------
            | Structure Items
            |--------------------------------------------------------------------------
            */

            'structures.*.head_term_id' => [
                'required',
                'integer',
                'exists:terms,id',
            ],

            'structures.*.pattern_id' => [
                'required',
                'integer',
                'exists:student_fee_structure_patterns,id',
            ],

            'structures.*.amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'structures.*.amount_type' => [
                'required',
                'in:per_period,total',
            ],

            'structures.*.reason' => [
                'nullable',
                'string',
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Get Student Overrides
    |--------------------------------------------------------------------------
    */

    public function showCustom(
        $studentId,
        $yearId
    ) {

        $data =
            StudentFeeStructureOverride::query()

                ->with([

					'student:id,name',

					'classTerm:id,name',

	                'sectionTerm:id,name',

                    'feeStructure:id,head_term_id,pattern_id',

                    'feeStructure.headTerm:id,name',

                    'feeStructure.pattern:id,name',
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

        'class_term_id' =>
            $item->class_term_id,

        'class_name' =>
            $item->classTerm?->name,

        'section_term_id' =>
            $item->section_term_id,

        'section_name' =>
            $item->sectionTerm?->name,

        /*
        |--------------------------------------------------------------------------
        | Structure
        |--------------------------------------------------------------------------
        */

        'fee_structure_id' =>
            $item->fee_structure_id,

        /*
        |--------------------------------------------------------------------------
        | Head
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
        | Amount
        |--------------------------------------------------------------------------
        */

        'amount' =>
            $item->amount,

        'amount_type' =>
            $item->amount_type,

        /*
        |--------------------------------------------------------------------------
        | Extra
        |--------------------------------------------------------------------------
        */

        'reason' =>
            $item->reason,
    ];
});

        return response()->json([

            'status' => 'success',

            'data' => $data,

        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Store Student Custom Structures
    |--------------------------------------------------------------------------
    */

    public function storeCustom(
        Request $request,
        $studentId,
        $yearId
    ) {

        $validated =
            $request->validate(
                $this->validationRules()
            );

        $saved = [];

        foreach (
            $validated['structures']
            as $structure
        ) {

            /*
            |--------------------------------------------------------------------------
            | Find Matching Base Structure
            |--------------------------------------------------------------------------
            */

            $feeStructure =
                StudentFeeStructure::query()

                    ->where(
                        'year_id',
                        $yearId
                    )

                    ->where(
                        'head_term_id',
                        $structure['head_term_id']
                    )

                    ->first();

            /*
            |--------------------------------------------------------------------------
            | Skip Invalid Structure
            |--------------------------------------------------------------------------
            */

            if (! $feeStructure) {

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Create / Update Override
            |--------------------------------------------------------------------------
            */

            $override =

                StudentFeeStructureOverride::updateOrCreate(

                    [

                        'student_id' =>
                            $studentId,

                        'year_id' =>
                            $yearId,

                        'head_term_id' =>
                            $feeStructure->head_term_id,
                    ],

                    [

                        /*
                        |--------------------------------------------------------------------------
                        | Base Structure Reference
                        |--------------------------------------------------------------------------
                        */

                        'fee_structure_id' =>
                            $feeStructure->id,

                        /*
                        |--------------------------------------------------------------------------
                        | Context
                        |--------------------------------------------------------------------------
                        */

                        'year_id' =>
                            $feeStructure->year_id,

                        'class_term_id' =>
                            $feeStructure->class_term_id,

                        'section_term_id' =>
                            $feeStructure->section_term_id,

                        /*
                        |--------------------------------------------------------------------------
                        | Head
                        |--------------------------------------------------------------------------
                        */

                        'head_term_id' =>
                            $feeStructure->head_term_id,

                        /*
                        |--------------------------------------------------------------------------
                        | Pattern
                        |--------------------------------------------------------------------------
                        */

                        'pattern_id' =>
                            $structure['pattern_id'],

                        /*
                        |--------------------------------------------------------------------------
                        | Amount
                        |--------------------------------------------------------------------------
                        */

                        'amount' =>
                            $structure['amount'],

                        'amount_type' =>
                            $structure['amount_type'],

                        /*
                        |--------------------------------------------------------------------------
                        | Extra
                        |--------------------------------------------------------------------------
                        */

                        'reason' =>
                            $structure['reason']
                            ?? null,
                    ]
                );

            $saved[] = $override;
        }

        /*
        |--------------------------------------------------------------------------
        | Refresh Student Dues
        |--------------------------------------------------------------------------
        */

        app(
            \Modules\Student\Services\RefreshStudentFeeDuesService::class
        )->handle(
            $studentId,
            $yearId
        );

        return response()->json([

            'status' => 'success',

            'message' =>
                'Student custom fee structure saved successfully.',

            'data' => $saved,

        ], Response::HTTP_CREATED);
    }
}