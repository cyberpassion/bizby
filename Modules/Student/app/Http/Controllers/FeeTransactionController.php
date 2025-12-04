<?php

namespace App\Http\Controllers\Api;

use App\Models\FeeTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\FeeCalculationService;

class FeeTransactionController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|numeric',
            'amount'     => 'required|numeric|min:1',
            'payment_mode' => 'nullable|string',
            'reference' => 'nullable|string'
        ]);

        $transaction = FeeTransaction::create($data);

        // Allocate across dues
        $service = new FeeCalculationService();
        $service->allocatePayment($transaction);

        return response()->json([
            'message' => 'Payment recorded & allocated',
            'transaction' => $transaction->load('items')
        ]);
    }
}
