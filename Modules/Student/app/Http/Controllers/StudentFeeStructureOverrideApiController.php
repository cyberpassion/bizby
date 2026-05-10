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

            'structures.*.head_term_id' => [
                'required',
                'integer',
                'exists:terms,id',
            ],

            'structures.*.selected_periods' => [
                'required',
                'array',
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

    public function showCustom($studentId, $yearId)
    {
        $data = StudentFeeStructureOverride::query()

            ->with([
                'feeStructure:id,head_term_id',
                'feeStructure.headTerm:id,name',
            ])

            ->where('student_id', $studentId)

            ->whereHas('feeStructure', function ($q) use ($yearId) {

                $q->where('year_id', $yearId);
            })

            ->get()

            ->map(function ($item) {

                return [

                    'id' => $item->id,

                    'student_id' =>
                        $item->student_id,

                    'fee_structure_id' =>
                        $item->fee_structure_id,

                    'head_term_id' =>
                        $item->feeStructure?->head_term_id,

                    'head_name' =>
                        $item->feeStructure?->head?->name,

                    'selected_periods' =>
                        $item->selected_periods,

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
    | Store Student Custom Fee Structure
    |--------------------------------------------------------------------------
    |
    | POST /students/{studentId}/fee-structure-overrides/{yearId}
    |
    */

    public function storeCustom(
        Request $request,
        $studentId,
        $yearId
    ) {

        $validated = $request->validate(
            $this->validationRules()
        );

        $saved = [];

        foreach ($validated['structures'] as $structure) {

            /*
            |--------------------------------------------------------------------------
            | Resolve Base Fee Structure
            |--------------------------------------------------------------------------
            */

            $feeStructure = StudentFeeStructure::query()

                ->where('year_id', $yearId)

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

            if (!$feeStructure) {
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

                        'fee_structure_id' =>
                            $feeStructure->id,
                    ],

                    [

                        /*
                        |--------------------------------------------------------------------------
                        | Legacy Summary Amount
                        |--------------------------------------------------------------------------
                        |
                        | Optional summary field.
                        | First selected period amount.
                        |
                        */

                        'override_amount' =>

                            collect(
                                $structure['selected_periods']
                            )->first() ?? 0,

                        /*
                        |--------------------------------------------------------------------------
                        | Actual Override Data
                        |--------------------------------------------------------------------------
                        */

                        'selected_periods' =>
                            $structure['selected_periods'],

                        'reason' =>
                            $structure['reason'] ?? null,
                    ]
                );

            $saved[] = $override;
        }

        return response()->json([

            'status' => 'success',

            'message' =>
                'Student fee structure saved successfully',

            'data' => $saved,

        ], Response::HTTP_CREATED);
    }
}