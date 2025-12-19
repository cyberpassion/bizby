<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Modules\Student\Models\StudentPromotion;
use Modules\Student\Models\StudentAcademicHistory;

class StudentPromotionApiController extends Controller
{
    /**
     * List all promotions/demotions
     */
    public function index(Request $request)
    {
        $promotions = StudentPromotion::with(['student', 'fromClass', 'toClass', 'fromSection', 'toSection', 'academicYear'])
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $promotions,
        ], Response::HTTP_OK);
    }

    /**
     * Promote / Demote a student
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|integer|exists:students,id',
            'from_class_term_id' => 'required|integer|exists:terms,id',
            'to_class_term_id' => 'required|integer|exists:terms,id',
            'from_section_term_id' => 'required|integer|exists:terms,id',
            'to_section_term_id' => 'required|integer|exists:terms,id',
            'student_academic_year_id' => 'required|integer|exists:student_academic_years,id',
            'type' => 'required|in:promotion,demotion,repeat',
            'remarks' => 'nullable|string',
        ]);

        // 1️⃣ Create promotion record
        $promotion = StudentPromotion::create($data);

        // 2️⃣ Update student's academic history if promotion
        if ($data['type'] === 'promotion') {
            StudentAcademicHistory::create([
                'student_id' => $data['student_id'],
                'student_academic_year_id' => $data['student_academic_year_id'],
                'class_term_id' => $data['to_class_term_id'],
                'section_term_id' => $data['to_section_term_id'],
                'status' => 'active',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Student promotion/demotion saved successfully',
            'data' => $promotion,
        ], Response::HTTP_CREATED);
    }

    /**
     * Show a single promotion record
     */
    public function show($id)
    {
        $promotion = StudentPromotion::with(['student', 'fromClass', 'toClass', 'fromSection', 'toSection', 'academicYear'])
            ->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $promotion,
        ]);
    }
}
