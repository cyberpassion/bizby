<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class StudentFeeStructure extends Model
{
	use HasFactory;

    protected $fillable = [];

	protected $casts = [
	    'selected_periods' => 'array',
	];

    public function amountForMonth(int|string $month): float
    {
        $month = str_pad($month, 2, '0', STR_PAD_LEFT);
        return $this->selected_periods[$month] ?? $this->amount;
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
