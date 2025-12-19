<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Modules\Student\Models\StudentFeeSubmission;
use Carbon\Carbon;

class StudentFeeCollectionApiController extends Controller
{
    /**
     * Generate fee collection / dues report
     */
    public function report(Request $request)
    {
        $data = $request->validate([]);

        $reportType = $data['report_type'] ?? 'custom';

        switch ($reportType) {
            case 'day':
                $report = $this->dayWiseReport($data);
                break;
            case 'week':
                $report = $this->weekWiseReport($data);
                break;
            case 'month':
                $report = $this->monthWiseReport($data);
                break;
            default:
                $report = $this->customDateReport($data);
                break;
        }

        return response()->json([
            'status' => 'success',
            'data' => ['data'=>$report],
        ]);
    }

    /**
     * Day-wise report
     */
    protected function dayWiseReport(array $data)
    {
        $date = Carbon::parse($data['date'] ?? now());

        $query = $this->baseQuery($data)
            ->whereDate('created_at', $date);

        return $query->get();
    }

    /**
     * Week-wise report (week number in year)
     */
    protected function weekWiseReport(array $data)
    {
        $week = $data['week'] ?? Carbon::now()->weekOfYear;
        $year = Carbon::now()->year;

        $query = $this->baseQuery($data)
            ->whereYear('created_at', $year)
            ->whereRaw('WEEKOFYEAR(created_at) = ?', [$week]);

        return $query->get();
    }

    /**
     * Month-wise report
     */
    protected function monthWiseReport(array $data)
    {
        $month = $data['month'] ?? Carbon::now()->month;
        $year = Carbon::now()->year;

        $query = $this->baseQuery($data)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month);

        return $query->get();
    }

    /**
     * Custom date range report
     */
    protected function customDateReport(array $data)
    {
        $from = Carbon::parse($data['date_from'] ?? now()->startOfMonth());
        $to   = Carbon::parse($data['date_to'] ?? now());

        $query = $this->baseQuery($data)
            ->whereBetween('created_at', [$from, $to]);

        return $query->get();
    }

    /**
     * Base query with common filters (year, class, section)
     */
    protected function baseQuery(array $data)
    {
        $query = StudentFeeSubmission::query();

        if (!empty($data['year_id'])) {
            $query->where('year_id', $data['year_id']);
        }
        if (!empty($data['class_term_id'])) {
            $query->where('class_term_id', $data['class_term_id']);
        }
        if (!empty($data['section_term_id'])) {
            $query->where('section_term_id', $data['section_term_id']);
        }

        // Include related items for detailed dues
        $query->with('items');

        return $query;
    }
}
