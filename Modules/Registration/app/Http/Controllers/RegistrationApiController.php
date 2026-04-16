<?php

namespace Modules\Registration\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Registration\Models\Registration;
use Modules\Shared\Http\Controllers\SharedApiController;

class RegistrationApiController extends SharedApiController
{
    protected function model()
    {
        return Registration::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'type' => 'required|string',
            'registration_status' => 'nullable|string',
        ];
    }

    /**
     * Charts available
     */
    protected function allowedCharts(): array
    {
        return [
            'registration_status',
            'type',
        ];
    }

    /**
     * Default KPI metrics
     */
    protected function defaultMetrics(): array
    {
        return [
            'total_records',
            'submitted_records',
            'draft_records',
            'new_this_month',
        ];
    }

    /**
     * Aggregates (cards)
     */
    protected function defaultAggregates(): array
    {
        return [
            'count:registration_status=draft',
            'count:registration_status=submitted',
        ];
    }

    /**
     * Grouping (charts)
     */
    protected function defaultGroups(): array
    {
        return [
            'registration_status',
            'type',
        ];
    }

    /**
     * Extra custom stats
     */
    public function extraStats()
    {
        return [
            'total_registrations' => Registration::count(),

            'draft_registrations' => Registration::where('registration_status', 'draft')->count(),

            'submitted_registrations' => Registration::where('registration_status', 'submitted')->count(),

            'recent_registrations' => Registration::whereMonth('created_at', now()->month)->count(),

            // Optional if you later add payments
            // 'total_revenue' => Registration::sum('amount'),
        ];
    }

    /**
     * Custom create (override default store if needed)
     */
    public function create(Request $request)
    {
        return Registration::create([
            'user_id' => $request->user()->id,
            'type' => $request->type,
            'meta' => config("registration.types.{$request->type}")
        ]);
    }

    public function my()
    {
        return Registration::where('user_id', auth()->id())
            ->with('steps', 'documents', 'payments')
            ->latest()
            ->get();
    }

    public function submit($id)
    {
        $reg = Registration::findOrFail($id);

        $reg->update([
            'registration_status' => 'submitted',
            'submitted_at' => now()
        ]);

        return $reg;
    }
}