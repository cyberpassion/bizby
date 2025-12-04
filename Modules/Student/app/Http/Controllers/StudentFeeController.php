<?php

namespace App\Http\Controllers\Api;

use App\Models\StudentFee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentFeeController extends Controller
{
    public function index($studentId)
    {
        return StudentFee::where('student_id', $studentId)
            ->orderBy('period_code')
            ->get();
    }

    public function cancel(Request $request, $id)
    {
        $fee = StudentFee::findOrFail($id);

        $fee->cancel_reason = $request->cancel_reason;
        $fee->cancelled_at = now();
        $fee->is_active = false;
        $fee->save();

        return $fee;
    }
}
