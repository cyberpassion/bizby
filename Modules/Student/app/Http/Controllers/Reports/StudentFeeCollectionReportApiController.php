<?php

namespace Modules\Student\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Student\Models\StudentFeeSubmission;
use Modules\Student\Models\StudentFeeSubmissionItem;

class StudentFeeCollectionReportApiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Collection Report
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = StudentFeeSubmission::query()

            ->with([

                'student:id,name,phone,father_name',

                'academicYear:id,name',

                'classTerm:id,name,group',

                'sectionTerm:id,name,group',
            ]);

        /*
        |--------------------------------------------------------------------------
        | Filters
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('year_id') &&
            $request->year_id !== 'all'
        ) {

            $query->where(
                'year_id',
                $request->year_id
            );
        }

        if (
            $request->filled('class_term_id') &&
            $request->class_term_id !== 'all'
        ) {

            $query->where(
                'class_term_id',
                $request->class_term_id
            );
        }

        if (
            $request->filled('section_term_id') &&
            $request->section_term_id !== 'all'
        ) {

            $query->where(
                'section_term_id',
                $request->section_term_id
            );
        }

        if (
            $request->filled('from_date')
        ) {

            $query->whereDate(
                'receipt_date',
                '>=',
                $request->from_date
            );
        }

        if (
            $request->filled('to_date')
        ) {

            $query->whereDate(
                'receipt_date',
                '<=',
                $request->to_date
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Result
        |--------------------------------------------------------------------------
        */

        $result = $query

            ->latest()

            ->paginate(
                $request->get('per_page', 20)
            )

            ->through(function ($item) {

                return [

                    'id' => $item->id,

                    /*
                    |--------------------------------------------------------------------------
                    | Student
                    |--------------------------------------------------------------------------
                    */

                    'student_id' =>
                        $item->student_id,

                    'student_name' =>
                        $item->student?->name,

                    'student_phone' =>
                        $item->student?->phone,

                    'father_name' =>
                        $item->student?->father_name,

                    /*
                    |--------------------------------------------------------------------------
                    | Academic
                    |--------------------------------------------------------------------------
                    */

                    'year_id' =>
                        $item->year_id,

                    'academic_year_name' =>
                        $item->academicYear?->name,

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
                    | Receipt
                    |--------------------------------------------------------------------------
                    */

                    'receipt_no' =>
                        $item->receipt_no,

                    'receipt_date' =>
                        $item->receipt_date,

                    /*
                    |--------------------------------------------------------------------------
                    | Amounts
                    |--------------------------------------------------------------------------
                    */

                    'gross_amount' =>
                        $item->gross_amount,

                    'discount_amount' =>
                        $item->discount_amount,

                    'fine_amount' =>
                        $item->fine_amount,

                    'paid_amount' =>
                        $item->paid_amount,

                    'balance_amount' =>
                        $item->balance_amount,

                    /*
                    |--------------------------------------------------------------------------
                    | Status
                    |--------------------------------------------------------------------------
                    */

                    'fee_status' =>
                        $item->fee_status,

                    'submission_status' =>
                        $item->submission_status,

                    /*
                    |--------------------------------------------------------------------------
                    | Payment
                    |--------------------------------------------------------------------------
                    */

                    'payment_mode' =>
                        $item->payment_mode,

                    'transaction_reference' =>
                        $item->transaction_reference,

                    /*
                    |--------------------------------------------------------------------------
                    | Other
                    |--------------------------------------------------------------------------
                    */

                    'remarks' =>
                        $item->remarks,

                    'paid_at' =>
                        $item->paid_at,

                    'created_at' =>
                        $item->created_at,
                ];
            });

        return response()->json([

            'status' => 'success',

            'data' => $result,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Daily Collection Report
    |--------------------------------------------------------------------------
    */

    public function daily(Request $request)
    {
        $query = StudentFeeSubmission::query();

        if (
            $request->filled('year_id') &&
            $request->year_id !== 'all'
        ) {

            $query->where(
                'year_id',
                $request->year_id
            );
        }

        if (
            $request->filled('from_date')
        ) {

            $query->whereDate(
                'receipt_date',
                '>=',
                $request->from_date
            );
        }

        if (
            $request->filled('to_date')
        ) {

            $query->whereDate(
                'receipt_date',
                '<=',
                $request->to_date
            );
        }

        $data = $query

            ->selectRaw(
                'DATE(receipt_date) as date'
            )

            ->selectRaw(
                'SUM(paid_amount) as total_collection'
            )

            ->groupBy('date')

            ->orderBy('date')

            ->get();

        return response()->json([

            'status' => 'success',

            'data' => $data,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Head Wise Collection
    |--------------------------------------------------------------------------
    */

    public function headWise(Request $request)
    {
        $query = StudentFeeSubmissionItem::query()

            ->with([
                'due.headTerm:id,name'
            ]);

        $data = $query

            ->select('due_id')

            ->selectRaw(
                'SUM(paid_amount) as total_paid'
            )

            ->groupBy('due_id')

            ->get()

            ->map(function ($item) {

                return [

                    'due_id' =>
                        $item->due_id,

                    'head_name' =>
                        $item->due?->headTerm?->name,

                    'total_paid' =>
                        $item->total_paid,
                ];
            });

        return response()->json([

            'status' => 'success',

            'data' => $data,
        ]);
    }
}