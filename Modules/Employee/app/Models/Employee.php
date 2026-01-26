<?php

namespace Modules\Employee\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class Employee extends TenantModel
{
    use HasFactory;

    /**
     * NOTE:
     * We keep fillable empty because we override getFillable().
     * Laravel will NOT use this array.
     */
    protected $fillable = [];

    /**
     * Fields that should NEVER be mass assignable.
     * These are automatically removed from dynamicFillable().
     */
    protected $guarded = [
        'employee_id',  // primary key (never mass assigned)
        'created_at',       // timestamp
        'updated_at',       // timestamp
        'deleted_at',       // soft delete timestamp
    ];

    /**
     * Attribute casting (auto converts to Carbon).
     */
    protected $casts = [
        'datetime'          => 'datetime',
        'employee_date' => 'date',
    ];

    /**
     * Default values for columns.
     */
    protected $attributes = [];

    /**
     * Additional attributes that do NOT exist in DB.
     * These appear automatically in JSON output.
     */
    protected $appends = [];

	/**
     * Dynamically determine fillable columns by:
     * 1. Fetching all columns from the database table
     * 2. Excluding all guarded columns
     *
     * This allows you to modify the DB structure freely
     * without updating the model each time.
     */
    protected function dynamicFillable()
    {
        // Get all columns from the table
        $columns = Schema::getColumnListing($this->getTable());

        // Exclude guarded columns from the fillable list
        return array_diff($columns, $this->guarded);
    }

    /**
     * Override getFillable() so Laravel uses our dynamic fillable logic.
     * Laravel internally calls this method for mass assignment checks.
     */
    public function getFillable()
    {
        return $this->dynamicFillable();
    }

}