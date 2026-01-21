<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Student\Models\Traits\StudentPayable;

// Online Payments Specific
use Modules\Shared\Contracts\OnlinePayments\Payable;
use Modules\Shared\Contracts\OnlinePayments\FinalizePayment;

class Student extends Model implements Payable, FinalizePayment
{
    use HasFactory;
	use StudentPayable; // Payable implementation trait

    // dynamically allow all columns except id, timestamps, deleted_at
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

	protected $casts = [
        'admission_date' => 'date',
    ];

    public function academicHistories()
	{
    	return $this->hasMany(StudentAcademicHistory::class);
	}

	public function currentAcademicHistory()
	{
    	return $this->hasOne(StudentAcademicHistory::class)->where('is_current', true);
	}

}
