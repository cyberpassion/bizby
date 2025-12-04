<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Student\Models\Student;

class FeeTransaction extends Model
{
    protected $table = 'cyp_fee_transaction';

    protected $fillable = [
        'student_id',
        'amount',
        'payment_mode',
        'reference',
        'date'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function items()
    {
        return $this->hasMany(FeeTransactionItem::class, 'transaction_id');
    }
}
