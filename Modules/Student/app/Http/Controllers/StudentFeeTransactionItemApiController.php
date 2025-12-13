<?php

namespace Modules\Student\Http\Controllers;

use Modules\Shared\Http\Controllers\SharedApiController;
use Modules\Student\Models\StudentFeeTransactionItem;

class StudentFeeTransactionItemApiController extends SharedApiController
{
    protected function model()
    {
        return StudentFeeTransactionItem::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'transaction_id' => 'required|exists:student_fee_transactions,id',
            'student_fee_id' => 'required|exists:student_fees,id',
            'amount_paid'    => 'required|numeric|min:1'
        ];
    }
}
