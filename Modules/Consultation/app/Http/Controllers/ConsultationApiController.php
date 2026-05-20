<?php

namespace Modules\Consultation\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Consultation\Models\Consultation;
use Modules\Shared\Http\Controllers\SharedApiController;
use Modules\Shared\Services\RealtimeService;

class ConsultationApiController extends SharedApiController
{
    protected function model()
    {
        return Consultation::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }

    // Default Graphs to Display
    protected function allowedCharts(): array
    {
        return [
            'gender',              // Male / Female / Other
            'channel',             // Web / Mobile / Walk-in / API
            'consultation_type',   // Online / Offline / Video etc.
            'consultant_type',     // Doctor / Counselor / Expert
            'category',            // General / OBC / SC / ST
            'marital_status',      // Single / Married / Widowed / Divorced
            'consultation_date',   // Date-wise trend
            'consultant_id',       // Consultant-wise load
            // 'age_group'            // Age range graph (logic based)
        ];
    }

    // Default Metrics
    protected function defaultMetrics(): array
    {
        return [
            'total_records',          // Total consultations / entries
            'total_revenue',           // Sum of consultation_fee
        ];
    }

    // Default Sums
    protected function defaultAggregates(): array
    {
        return [
            'count:gender=M',                 // Male count
            'count:gender=F',                 // Female count
            'sum:consultation_fee',           // Total revenue
        ];
    }

    // Default grouping columns
    protected function defaultGroups(): array
    {
        return [
            'gender',              // Gender graph
            'channel',             // Channel-wise graph
            'consultation_type',   // Consultation type graph
            'consultation_date',    // Date-wise trend
        ];
    }

    public function updateStatus(Request $request, $consultationId)
    {
        $request->validate([
            'patient_status' => 'required|in:waiting,checked_in,in_consultation,completed,followup,not_arrived,cancelled,skipped',
        ]);

        $consultation = Consultation::findOrFail($consultationId);

        $consultation->update([
            'patient_status' => $request->patient_status,
        ]);

        // Broadcast realtime update
        RealtimeService::module(
            'consultation',
            'consultation.status.updated',
            [
                'consultation_id' => $consultation->id,
                'patient_status' => $consultation->patient_status,
                'consultation' => $consultation,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
            'data' => $consultation,
        ]);
    }
}
