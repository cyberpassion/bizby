<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class StudentFeeTransactionItem extends Model
{

	use HasFactory;

    protected $fillable = [
        'transaction_id',
        'fee_head_id',
        'academic_year',
        'amount',
        'discount',
        'paid_amount',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'discount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
    ];

	protected static function newFactory()
	{
    	return \Modules\Student\Database\Factories\StudentFeeTransactionItemFactory::new();
	}

    public function transaction()
    {
        return $this->belongsTo(StudentFeeTransaction::class, 'transaction_id');
    }

    public function feeHead()
    {
        return $this->belongsTo(StudentFeeHead::class, 'fee_head_id');
    }

	public function studentFee()
	{
    	return $this->belongsTo(\Modules\Student\Models\StudentFee::class, 'student_fee_id');
	}

}
