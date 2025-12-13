<?php

namespace Modules\Student\Http\Controllers;

use Modules\Student\Models\StudentFeeTransaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Student\Services\FeeCalculationService;
use Modules\Student\Services\FeeAllocationService;
use Illuminate\Support\Facades\DB;

class StudentFeeTransactionApiController extends Controller
{
    protected $feeService;

    public function __construct(FeeCalculationService $service)
    {
        $this->feeService = $service;
    }

    public function store(Request $request)
	{
    	$data = $request->validate([
        	'student_id'   => 'required|exists:students,id',
    	    'amount'       => 'required|numeric|min:1',
        	'payment_mode' => 'nullable|string',
        	'reference'    => 'nullable|string',
	    ]);

	    // Atomic + clean
    	$transactionModel = DB::transaction(function () use ($data) {

	        $transaction = StudentFeeTransaction::create([
    	        'student_id'   => $data['student_id'],
        	    'amount'       => $data['amount'],
            	'payment_mode' => $data['payment_mode'] ?? null,
            	'reference'    => $data['reference'] ?? null,
            	'date'         => now(),
	        ]);

    	    app(FeeAllocationService::class)->allocate($transaction);

	        return $transaction;
    	}, 5);

	    return response()->json([
    	    'message' => 'Payment recorded & allocated',
        	'transaction' => $transactionModel->load('items'),
    	], Response::HTTP_CREATED);
	}

}
