<?php

namespace Modules\Employee\Services;

use Carbon\Carbon;
use Modules\Employee\Models\Employee;

class EmployeeAIService
{
    /**
     * Main employee AI handler
     */
    public function handle(string $prompt, $user = null): array
    {
        $intent = $this->detectIntent($prompt);

        return match ($intent) {

            'employee_count' => $this->employeeCount(),

            'today_attendance' => $this->todayAttendance(),

            'salary_summary' => $this->salarySummary(),

            default => [
                'success' => false,
                'message' => 'Sorry, employee request not understood.',
            ],
        };
    }

    /**
     * Detect employee intent
     */
    protected function detectIntent(string $prompt): ?string
    {
        $prompt = strtolower($prompt);

        /*
        |--------------------------------------------------------------------------
        | Employee Count
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($prompt, 'total employees') ||
            str_contains($prompt, 'employee count') ||
            str_contains($prompt, 'how many employees')
        ) {
            return 'employee_count';
        }

        /*
        |--------------------------------------------------------------------------
        | Attendance
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($prompt, 'attendance') ||
            str_contains($prompt, 'present today')
        ) {
            return 'today_attendance';
        }

        /*
        |--------------------------------------------------------------------------
        | Salary
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($prompt, 'salary') ||
            str_contains($prompt, 'payroll')
        ) {
            return 'salary_summary';
        }

        return null;
    }

    /**
     * Total employee count
     */
    protected function employeeCount(): array
    {
        $count = Employee::count();

        return [
            'success' => true,
            'type' => 'employee_count',
            'data' => [
                'total_employees' => $count,
            ],
            'ai_prompt' => "
                Total Employees: {$count}

                Generate a short professional summary.
            ",
        ];
    }

    /**
     * Today's attendance summary
     */
    protected function todayAttendance(): array
    {
        // Example only
        // Replace with your actual attendance logic

        $presentCount = 42;

        return [
            'success' => true,
            'type' => 'today_attendance',
            'data' => [
                'date' => Carbon::today()->toDateString(),
                'present_employees' => $presentCount,
            ],
            'ai_prompt' => '
                Date: '.Carbon::today()->toDateString()."

                Present Employees: {$presentCount}

                Generate attendance insights.
            ",
        ];
    }

    /**
     * Salary summary
     */
    protected function salarySummary(): array
    {
        // Example only
        // Replace with payroll calculations

        $totalSalary = 250000;

        return [
            'success' => true,
            'type' => 'salary_summary',
            'data' => [
                'total_salary' => $totalSalary,
            ],
            'ai_prompt' => "
                Total Salary Payout: {$totalSalary}

                Generate payroll summary.
            ",
        ];
    }
}
