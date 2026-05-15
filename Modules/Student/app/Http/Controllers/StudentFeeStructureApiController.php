<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\Shared\Http\Controllers\SharedApiController;

use Modules\Student\Models\StudentFeeStructure;

class StudentFeeStructureApiController extends SharedApiController
{
    protected $searchable = [];

    /*
    |--------------------------------------------------------------------------
    | Model
    |--------------------------------------------------------------------------
    */

    protected function model()
    {
        return StudentFeeStructure::class;
    }

    /*
    |--------------------------------------------------------------------------
    | Validation Rules
    |--------------------------------------------------------------------------
    */

    protected function validationRules($id = null)
    {
        return [

            'year_id' => [
                'required',
                'exists:student_academic_years,id'
            ],

            'class_term_id' => [
                'required',
                'exists:terms,id'
            ],

            'section_term_id' => [
                'nullable',
                'exists:terms,id'
            ],

            /*
            |--------------------------------------------------------------------------
            | Structures
            |--------------------------------------------------------------------------
            */

            'structures' => [
                'required',
                'array',
                'min:1'
            ],

            'structures.*.head_term_id' => [
                'required',
                'exists:terms,id'
            ],

            'structures.*.pattern_id' => [
                'required',
                'exists:student_fee_structure_patterns,id'
            ],

            'structures.*.amount' => [
                'required',
                'numeric',
                'min:0'
            ],

            'structures.*.amount_type' => [
                'required',
                'in:per_period,total'
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $validated = $request->validate([

            'year_id' => [
                'required',
                'exists:student_academic_years,id'
            ],

            'class_term_id' => [
                'required',
                'exists:terms,id'
            ],

            'section_term_id' => [
                'nullable',
                'exists:terms,id'
            ],
        ]);

        $query = StudentFeeStructure::query()

            ->with([

                'headTerm:id,name',

                'pattern:id,name,key',
            ])

            ->where(
                'year_id',
                $validated['year_id']
            )

            ->where(
                'class_term_id',
                $validated['class_term_id']
            );

        /*
        |--------------------------------------------------------------------------
        | Section Filter
        |--------------------------------------------------------------------------
        */

        if (
            ! empty(
                $validated['section_term_id']
            )
        ) {

            $query->where(
                'section_term_id',
                $validated['section_term_id']
            );

        } else {

            $query->whereNull(
                'section_term_id'
            );
        }

        $data = $query
            ->latest()
            ->get()

            ->map(function ($item) {

                return [

                    'id' => $item->id,

                    'year_id' =>
                        $item->year_id,

                    'class_term_id' =>
                        $item->class_term_id,

                    'section_term_id' =>
                        $item->section_term_id,

                    /*
                    |--------------------------------------------------------------------------
                    | Head
                    |--------------------------------------------------------------------------
                    */

                    'head_term_id' =>
                        $item->head_term_id,

                    'head_term_name' =>
                        $item->headTerm?->name,

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
                ];
            });

        return response()->json([

            'status' => 'success',

            'data' => [
                'data' => $data
            ]

        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate(
            $this->validationRules()
        );

        $rows = [];

        foreach (
            $validated['structures']
            as $structure
        ) {

            $rows[] = [

                'year_id' =>
                    $validated['year_id'],

                'class_term_id' =>
                    $validated['class_term_id'],

                'section_term_id' =>
                    $validated['section_term_id'],

                /*
                |--------------------------------------------------------------------------
                | Head
                |--------------------------------------------------------------------------
                */

                'head_term_id' =>
                    $structure['head_term_id'],

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
                | Timestamps
                |--------------------------------------------------------------------------
                */

                'created_at' => now(),

                'updated_at' => now(),
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Upsert
        |--------------------------------------------------------------------------
        */

        StudentFeeStructure::upsert(

            $rows,

            [
                'year_id',
                'class_term_id',
                'section_term_id',
                'head_term_id',
                'pattern_id'
            ],

            [
                'amount',
                'amount_type',
                'updated_at'
            ]
        );

        return response()->json([

            'status' => 'success',

            'message' =>
                'Fee structures saved successfully.'

        ], Response::HTTP_CREATED);
    }
}