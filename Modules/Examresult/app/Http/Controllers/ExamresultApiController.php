<?php

namespace Modules\Examresult\Http\Controllers;

use Modules\Examresult\Models\Examresult;
use Modules\Shared\Http\Controllers\SharedApiController;

class ExamresultApiController extends SharedApiController
{
    protected function model()
    {
        return Examresult::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
    protected function allowedCharts(): array
    {
        return [
            'exam_session',          // Session-wise exams (2024–25 etc.)
            'exam_name',             // Exam-wise distribution
            'exam_class',            // Class-wise exams
            'exam_section',          // Section-wise exams
            'exam_type',             // Mid-term / Final / Unit Test
            'examinee_id_type',      // Roll No / Registration No etc.
            'entry_source',          // Web / Mobile / System
            'announcement_datetime'  // Date-wise announcement trend
        ];
    }
    protected function defaultMetrics(): array
    {
        return [
            'total_exams',                // Total exam announcements
            'active_exams',               // status = 1
            'inactive_exams',             // status = 0
            'today_announcements'         // announcement_datetime = today
        ];
    }
    protected function defaultAggregates(): array
    {
        return [
            'count:exam_session',         // Session-wise count
            'count:exam_name',            // Exam-wise
            'count:exam_class',           // Class-wise
            'count:exam_section',         // Section-wise
            'count:exam_type',            // Exam type-wise
            'count:entry_source'          // Source-wise
        ];
    }
    protected function defaultGroups(): array
    {
        return [
            'exam_session',               // Session chart
            'exam_class',                 // Class-wise exams
            'exam_type',                  // Exam type chart
            'entry_source',               // Entry source chart
            'announcement_datetime'       // Date-wise trend
        ];
    }




}