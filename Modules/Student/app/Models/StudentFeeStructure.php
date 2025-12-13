<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class StudentFeeStructure extends Model
{

	use HasFactory;

    protected $fillable = [
        'academic_level_id',
        'fee_head_id',
        'academic_year',
        'frequency',
        'amount'
    ];

    protected $casts = [
        'amount' => 'decimal:2'
    ];

	protected static function newFactory()
	{
    	return \Modules\Student\Database\Factories\StudentFeeFactory::new();
	}

    public function class()
    {
        return $this->belongsTo(AcademicClass::class, 'academic_level_id');
    }

    public function feeHead()
    {
        return $this->belongsTo(StudentFeeHead::class, 'fee_head_id');
    }
}
