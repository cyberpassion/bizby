<?php

namespace Modules\Student\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class StudentFeeDiscount extends TenantModel
{
	use HasFactory;

    protected $fillable = [];

    protected $casts = [
    	'applicable_periods' => 'array',
	];

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
