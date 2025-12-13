<?php

namespace Modules\Student\Services;

use Modules\Student\Models\StudentFee;
use Modules\Student\Models\Student;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class FeeDuesService
{
    /**
     * Calculate dues for single student.
     *
     * Returns array of fee items with payable, concession, paid and due.
     *
     * @param int $studentId
     * @return array
     */
    public function calculateDues(int $studentId): array
    {
        // fetch fees with aggregated paid sums
        $fees = StudentFee::where('student_id', $studentId)
            ->where('is_active', true)
            ->with('feeHead:id,name')
            ->withSum('items as paid', 'amount_paid')
            ->orderBy('period_code')
            ->get();

        $result = [];
        $summary = ['total_payable' => 0.0, 'total_paid' => 0.0, 'total_due' => 0.0];

        foreach ($fees as $fee) {
            $payable = (float) $fee->payable;
            $concession = isset($fee->concession) ? (float) $fee->concession : 0.0;
            $paid = (float) ($fee->paid ?? 0.0);
            $effective = max($payable - $concession, 0.0);
            $due = max($effective - $paid, 0.0);

            $result[] = [
                'fee_id' => $fee->id,
                'fee_head' => $fee->feeHead->name ?? null,
                'period_code' => $fee->period_code,
                'period_label' => $fee->period_label,
                'payable' => $payable,
                'concession' => $concession,
                'paid' => $paid,
                'due' => $due,
                'status' => $due == 0 ? 'paid' : ($paid == 0 ? 'unpaid' : 'partially_paid')
            ];

            $summary['total_payable'] += $effective;
            $summary['total_paid'] += $paid;
            $summary['total_due'] += $due;
        }

        return ['items' => $result, 'summary' => $summary];
    }

    /**
     * Calculate dues for a list of students.
     * Returns map: student_id => [summary + items]
     *
     * @param array $studentIds
     * @return array
     */
    public function calculateDuesForStudents(array $studentIds): array
    {
        $out = [];
        foreach ($studentIds as $sid) {
            $out[$sid] = $this->calculateDues((int)$sid);
        }
        return $out;
    }

    /**
     * Class-level summary: returns total dues across students and per-student brief.
     *
     * @param array $studentIds
     * @return array
     */
    public function classDuesSummary(array $studentIds): array
    {
        $students = Student::whereIn('id', $studentIds)->get(['id','name','academic_level_id']);
        $details = [];
        $totalDue = 0.0;

        foreach ($students as $s) {
            $dues = $this->calculateDues((int)$s->id);
            $studentDue = $dues['summary']['total_due'] ?? 0.0;
            $details[] = [
                'student_id' => $s->id,
                'student_name' => $s->name,
                'academic_level_id' => $s->academic_level_id,
                'total_due' => $studentDue,
            ];
            $totalDue += $studentDue;
        }

        return [
            'class_total_due' => $totalDue,
            'per_student' => $details,
        ];
    }
}
