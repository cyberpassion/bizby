<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeTransactionItem extends Model
{

    protected $fillable = [
        'transaction_id',
        'student_fee_id',
        'amount_paid'
    ];

    public function transaction()
    {
        return $this->belongsTo(FeeTransaction::class, 'transaction_id');
    }

    public function fee()
    {
        return $this->belongsTo(StudentFee::class, 'student_fee_id');
    }
}
