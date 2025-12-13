<?php

namespace Modules\Student\Http\Controllers;

use Modules\Student\Models\StudentFee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Student\Services\FeeCalculationService;

use Carbon\Carbon;
use Modules\Student\Models\StudentFeeTransaction;

class StudentFeeApiController extends Controller
{
    protected $feeService;

    public function __construct(FeeCalculationService $service)
    {
        $this->feeService = $service;
    }

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

        return response()->json($fee);
    }

    public function dues($studentId)
    {
        $dues = $this->feeService->calculateDues($studentId);
        return response()->json($dues);
    }

	public function collectionReport(Request $request)
	{
    	$request->validate([
        	'from' => 'nullable|date',
	        'to' => 'nullable|date',
    	    'academic_level_id' => 'nullable|exists:academic_levels,id',
        	'fee_head_id' => 'nullable|exists:student_fee_heads,id'
	    ]);

	    $from = $request->get('from') ? Carbon::parse($request->get('from'))->startOfDay() : null;
    	$to = $request->get('to') ? Carbon::parse($request->get('to'))->endOfDay() : null;

	    $query = StudentFeeTransaction::query();

	    if ($from) $query->where('date', '>=', $from);
    	if ($to) $query->where('date', '<=', $to);
    	if ($request->filled('academic_level_id')) {
        	$query->whereHas('student', function ($q) use ($request) {
            	$q->where('academic_level_id', $request->academic_level_id);
	        });
    	}
	    if ($request->filled('fee_head_id')) {
    	    // aggregate using transaction items join
        	$query->whereHas('items', function($q) use ($request){
            	$q->whereHas('studentFee', function($qq) use ($request) {
                	$qq->where('fee_head_id', $request->fee_head_id);
	            });
    	    });
    	}

	    // Summary totals and grouped breakdown by date
    	$total = $query->sum('amount');

	    $grouped = $query->selectRaw('DATE(date) as day, SUM(amount) as collected')
    	    ->groupBy('day')
        	->orderBy('day', 'desc')
        	->get();

	    return response()->json([
    	    'total_collected' => (float)$total,
        	'breakdown' => $grouped,
    	]);
	}

	/**
	 * GET /v1/students/{student}/fee/invoice
	 */
	public function invoice($studentId)
	{
    	$student = \Modules\Student\Models\Student::with('academicLevel')->findOrFail($studentId);

	    $fees = \Modules\Student\Models\StudentFee::where('student_id', $studentId)
    	    ->where('is_active', true)
        	->with('feeHead:id,name')
        	->withSum('items as paid', 'amount_paid')
        	->get();

	    $transactions = \Modules\Student\Models\StudentFeeTransaction::where('student_id', $studentId)
    	    ->orderBy('date', 'desc')
        	->get();

	    $items = [];
    	$total = 0.0;
    	$totalPaid = 0.0;

	    foreach ($fees as $fee) {
    	    $payable = (float)$fee->payable;
        	$concession = (float)($fee->concession ?? 0.0);
	        $paid = (float)($fee->paid ?? 0.0);
    	    $effective = max($payable - $concession, 0.0);
        	$due = max($effective - $paid, 0.0);

	        $items[] = [
    	        'fee_id' => $fee->id,
        	    'fee_head' => $fee->feeHead->name ?? null,
            	'period_label' => $fee->period_label,
	            'payable' => $payable,
    	        'concession' => $concession,
        	    'paid' => $paid,
            	'due' => $due,
        	];

	        $total += $effective;
    	    $totalPaid += $paid;
    	}

	    return response()->json([
    	    'student' => [
        	    'id' => $student->id,
            	'name' => $student->name,
            	'academic_level' => $student->academicLevel->name ?? null,
	        ],
    	    'invoice' => [
        	    'items' => $items,
            	'total' => $total,
            	'paid' => $totalPaid,
            	'due' => max($total - $totalPaid, 0.0),
	        ],
    	    'transactions' => $transactions,
    	]);
	}

	public function classDuesReport(Request $request)
	{
    	$request->validate([
        	'academic_level_id' => 'required|exists:academic_levels,id',
	    ]);

	    $academicLevelId = $request->get('academic_level_id');

	    // get all students in this level
    	$studentIds = \Modules\Student\Models\Student::where('academic_level_id', $academicLevelId)->pluck('id')->toArray();

	    $duesService = app(\Modules\Student\Services\FeeDuesService::class);
    	$summary = $duesService->classDuesSummary($studentIds);

	    return response()->json($summary);
	}

}
