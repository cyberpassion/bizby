<?php

namespace Modules\Student\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class StudentFeeSubmission extends TenantModel
{
	use HasFactory;

    protected $fillable = [];

    protected $casts = [];

	// Relationship with submission items
    public function items()
    {
        return $this->hasMany(StudentFeeSubmissionItem::class, 'fee_submission_id');
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
