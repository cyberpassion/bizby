<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

use Modules\Student\Models\Student;
use Modules\Student\Models\StudentTransition;
use Modules\Student\Models\StudentAcademicHistory;
use Modules\Student\Models\StudentAcademicYear;

class StudentTransitionApiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | List Transitions
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = StudentTransition::query()
            ->with([
                'student:id,name,phone,father_name',
                'sourceAcademicYear:id,name',
                'targetAcademicYear:id,name',
                'sourceClass:id,name',
                'targetClass:id,name',
                'sourceSection:id,name',
                'targetSection:id,name',
            ]);

        if ($request->filled('transition_type')) {
            $query->where(
                'transition_type',
                $request->transition_type
            );
        }

        if ($request->filled('student_id')) {
            $query->where(
                'student_id',
                $request->student_id
            );
        }

        $result = $query
            ->latest()
            ->paginate(
                $request->get('per_page', 20)
            );

        return response()->json([
            'status' => 'success',
            'data'   => $result,
        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Create Transition
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [

        /*
        |--------------------------------------------------------------------------
        | Student Selection
        |--------------------------------------------------------------------------
        */

        'student_id' => [
            'nullable',
            'integer',
            'exists:students,id'
        ],

        'student_ids' => [
            'nullable',
            'array'
        ],

        'student_ids.*' => [
            'integer',
            'exists:students,id'
        ],

        /*
        |--------------------------------------------------------------------------
        | Transition Type
        |--------------------------------------------------------------------------
        */

        'transition_type' => [
            'required',
            'in:promotion,demotion,transfer,retain,graduate'
        ],

        /*
        |--------------------------------------------------------------------------
        | Source
        |--------------------------------------------------------------------------
        */

        'source_year_id' => [
            'required',
            'integer',
            'exists:student_academic_years,id'
        ],

        'source_class_term_id' => [
            'required',
            'integer',
            'exists:terms,id'
        ],

        'source_section_term_id' => [
            'required',
            'integer',
            'exists:terms,id'
        ],

        /*
        |--------------------------------------------------------------------------
        | Target
        |--------------------------------------------------------------------------
        */

        'target_year_id' => [
            'required',
            'integer',
            'exists:student_academic_years,id'
        ],

        'target_class_term_id' => [
            'required',
            'integer',
            'exists:terms,id'
        ],

        'target_section_term_id' => [
            'required',
            'integer',
            'exists:terms,id'
        ],

        /*
        |--------------------------------------------------------------------------
        | Additional
        |--------------------------------------------------------------------------
        */

        'effective_from' => [
            'nullable',
            'date'
        ],

        'remarks' => [
            'nullable',
            'string'
        ],
    ]);

    /*
    |--------------------------------------------------------------------------
    | Validation Error Response
    |--------------------------------------------------------------------------
    */

    if ($validator->fails()) {

        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed.',
            'errors' => $validator->errors(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    $data = $validator->validated();

    /*
    |--------------------------------------------------------------------------
    | Prevent Same Mapping
    |--------------------------------------------------------------------------
    */

    if (
        $data['source_year_id'] == $data['target_year_id']
        &&
        $data['source_class_term_id'] == $data['target_class_term_id']
        &&
        $data['source_section_term_id'] == $data['target_section_term_id']
    ) {

        return response()->json([
            'status'  => 'error',
            'message' => 'Source and target cannot be same.',
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /*
    |--------------------------------------------------------------------------
    | Resolve Students
    |--------------------------------------------------------------------------
    */

    if (!empty($data['student_id'])) {

        /*
        |--------------------------------------------------------------------------
        | Single Student
        |--------------------------------------------------------------------------
        */

        $studentIds = [
            $data['student_id']
        ];

    } elseif (!empty($data['student_ids'])) {

        /*
        |--------------------------------------------------------------------------
        | Selective Students
        |--------------------------------------------------------------------------
        */

        $studentIds = $data['student_ids'];

    } else {

        /*
        |--------------------------------------------------------------------------
        | Bulk Transition
        |--------------------------------------------------------------------------
        */

        $studentIds = StudentAcademicHistory::query()
            ->where('year_id', $data['source_year_id'])
            ->where('class_term_id', $data['source_class_term_id'])
            ->where('section_term_id', $data['source_section_term_id'])
            ->where('is_current', true)
            ->pluck('student_id')
            ->toArray();
    }

    /*
    |--------------------------------------------------------------------------
    | No Students Found
    |--------------------------------------------------------------------------
    */

    if (empty($studentIds)) {

        return response()->json([
            'status'  => 'error',
            'message' => 'No students found.',
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    DB::beginTransaction();

    try {

        $createdTransitions = [];

        foreach ($studentIds as $studentId) {

            /*
            |--------------------------------------------------------------------------
            | Prevent Duplicate Active History
            |--------------------------------------------------------------------------
            */

            $alreadyExists = StudentAcademicHistory::query()
                ->where('student_id', $studentId)
                ->where('year_id', $data['target_year_id'])
                ->where('class_term_id', $data['target_class_term_id'])
                ->where('section_term_id', $data['target_section_term_id'])
                ->where('is_current', true)
                ->exists();

            if ($alreadyExists) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Create Transition
            |--------------------------------------------------------------------------
            */

            $transition = StudentTransition::create([

                'student_id'              => $studentId,

                'transition_type'         => $data['transition_type'],

                'source_year_id'          => $data['source_year_id'],
                'source_class_term_id'    => $data['source_class_term_id'],
                'source_section_term_id'  => $data['source_section_term_id'],

                'target_year_id'          => $data['target_year_id'],
                'target_class_term_id'    => $data['target_class_term_id'],
                'target_section_term_id'  => $data['target_section_term_id'],

                'effective_from'          => $data['effective_from'] ?? now(),

                'remarks'                 => $data['remarks'] ?? null,

                'processed_by'            => auth()->id(),

                'status'                  => 'completed',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Close Current Academic History
            |--------------------------------------------------------------------------
            */

            StudentAcademicHistory::query()
                ->where('student_id', $studentId)
                ->where('is_current', true)
                ->update([
                    'is_current' => false,
                ]);

            /*
            |--------------------------------------------------------------------------
            | Create New Academic History
            |--------------------------------------------------------------------------
            */

            StudentAcademicHistory::create([

                'student_id'      => $studentId,

                'year_id'         => $data['target_year_id'],

                'class_term_id'   => $data['target_class_term_id'],

                'section_term_id' => $data['target_section_term_id'],

                'is_current'      => true,
            ]);

            $createdTransitions[] = $transition;
        }

        DB::commit();

        return response()->json([
            'status'  => 'success',
            'message' => 'Student transitions completed successfully.',
            'count'   => count($createdTransitions),
            'data'    => $createdTransitions,
        ], Response::HTTP_CREATED);

    } catch (\Throwable $e) {

        DB::rollBack();

        return response()->json([
            'status'  => 'error',
            'message' => $e->getMessage(),
            'line'    => $e->getLine(),
            'file'    => $e->getFile(),
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

    /*
    |--------------------------------------------------------------------------
    | Show Transition
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $transition = StudentTransition::query()
            ->with([
                'student:id,name,phone,father_name',

                'sourceAcademicYear:id,name',
                'targetAcademicYear:id,name',

                'sourceClass:id,name',
                'targetClass:id,name',

                'sourceSection:id,name',
                'targetSection:id,name',
            ])
            ->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data'   => $transition,
        ], Response::HTTP_OK);
    }
}