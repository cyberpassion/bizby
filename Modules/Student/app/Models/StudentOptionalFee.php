<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class StudentOptionalFee extends Model
{

	use HasFactory;

    protected $fillable = [
        'student_id',
        'fee_head_id',
        'academic_year',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

	protected static function newFactory()
	{
    	return \Modules\Student\Database\Factories\StudentOptionalFeeFactory::new();
	}

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function feeHead()
    {
        return $this->belongsTo(StudentFeeHead::class, 'fee_head_id');
    }
}
