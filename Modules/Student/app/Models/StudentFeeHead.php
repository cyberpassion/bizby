<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class StudentFeeHead extends Model
{

	use HasFactory;

    protected $fillable = [
        'name',
        'frequency', // monthly | quarterly | yearly | one_time
        'description',
        'is_optional',
        'default_amount',
        'is_active'
    ];

    protected $casts = [
        'is_optional' => 'boolean',
        'is_active' => 'boolean'
    ];

	protected static function newFactory()
	{
    	return \Modules\Student\Database\Factories\StudentFeeHeadFactory::new();
	}

    public function structures()
    {
        return $this->hasMany(StudentFeeStructure::class, 'fee_head_id');
    }

    public function optionalFees()
    {
        return $this->hasMany(StudentOptionalFee::class, 'fee_head_id');
    }

	public function feeHead()
	{
    	return $this->belongsTo(\Modules\Student\Models\StudentFeeHead::class, 'fee_head_id');
	}

	public function items()
	{
    	return $this->hasMany(\Modules\Student\Models\StudentFeeTransactionItem::class, 'student_fee_id');
	}

	public function transactions()
	{
    	// convenience relation via items -> transaction
    	return $this->hasManyThrough(
        	\Modules\Student\Models\StudentFeeTransaction::class,
	        \Modules\Student\Models\StudentFeeTransactionItem::class,
    	    'student_fee_id', // Foreign key on items table...
        	'id',             // Local key on transactions table...
        	'id',             // Local key on this table...
        	'transaction_id'  // Foreign key on items table for transaction
    	);
	}

}
