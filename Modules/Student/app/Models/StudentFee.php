<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Student\Models\Student;

class StudentFee extends Model
{

    protected $fillable = [
        'student_id',
        'fee_head_id',
        'class_id',
        'academic_year',
        'period_code',
        'period_label',
        'payable',
        'concession',
        'is_active',
        'cancelled_at',
        'cancel_reason',
    ];

    protected $appends = ['paid', 'balance'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function head()
    {
        return $this->belongsTo(FeeHead::class, 'fee_head_id');
    }

    public function transactionItems()
    {
        return $this->hasMany(FeeTransactionItem::class, 'student_fee_id');
    }

    /** Auto-calculated total paid */
    public function getPaidAttribute()
    {
        return $this->transactionItems()->sum('amount_paid');
    }

    /** Balance = payable - concession - paid */
    public function getBalanceAttribute()
    {
        return ($this->payable - $this->concession) - $this->paid;
    }
}
