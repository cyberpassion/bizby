<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class StudentFeeTransaction extends Model
{

	use HasFactory;

    protected $fillable = [
        'student_id',
        'academic_year',
        'receipt_no',
        'payment_mode',
        'transaction_date',
        'total_amount',
        'discount_amount',
        'final_amount',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'total_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'final_amount' => 'decimal:2',
    ];

	protected static function newFactory()
	{
    	return \Modules\Student\Database\Factories\StudentFeeTransactionFactory::new();
	}

	public function fee()
	{
    	return $this->belongsTo(StudentFee::class, 'fee_id');
	}

	public function student()
	{
    	return $this->belongsTo(\Modules\Student\Models\Student::class, 'student_id');
	}

	public function items()
	{
   		return $this->hasMany(\Modules\Student\Models\StudentFeeTransactionItem::class, 'transaction_id');
	}

}
