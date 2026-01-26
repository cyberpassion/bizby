<?php

namespace Modules\Student\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class StudentFeeSubmissionItem extends TenantModel
{
	use HasFactory;

    protected $fillable = [];

	protected $casts = [
        'selected_periods' => 'array', // automatically decode JSON
    ];

    // Optional: link back to submission
    public function submission()
    {
        return $this->belongsTo(StudentFeeSubmission::class, 'fee_submission_id');
    }

	protected function dynamicFillable()
    {
        // Example dynamic load from DB table
        return Schema::getColumnListing($this->getTable());
    }

    public function getFillable()
    {
        return $this->dynamicFillable();
    }
}
