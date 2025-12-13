<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class StudentFee extends Model
{

	use HasFactory;

    protected $fillable = [
        'student_id',
        'fee_head_id',
        'academic_level_id',
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

	protected static function newFactory()
	{
    	return \Modules\Student\Database\Factories\StudentFeeFactory::new();
	}

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function head()
    {
        return $this->belongsTo(StudentFeeHead::class, 'fee_head_id');
    }

    public function transactionItems()
    {
        return $this->hasMany(StudentFeeTransactionItem::class, 'student_fee_id');
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

	public function feeHead()
	{
    	return $this->belongsTo(StudentFeeHead::class, 'fee_head_id');
	}

	public function transactions()
	{
    	return $this->hasMany(StudentFeeTransaction::class, 'fee_id');
	}

}
