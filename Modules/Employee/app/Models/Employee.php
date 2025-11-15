<?php

namespace Modules\Employee\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class Employee extends Model
{
    use HasFactory;

    protected $connection = 'mysql'; // Always use mysql connection

	// Specify the custom table name
    protected $table = 'cyp_employee';

	// Specify custom primary key
	protected $primaryKey = 'employee_id';

    /**
     * If the primary key is not auto-incrementing, set this to false.
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    /**
     * Attribute casting.
     */
    protected $casts = [
		'datetime'			=> 'datetime',
        'employee_date' => 'date', // Laravel will cast it to Carbon
    ];

    /**
     * Default attribute values
     */
    protected $attributes = [
        'status' => 1,
    ];

    /**
     * Appended attributes (computed, not in DB)
     */
    protected $appends = [
        'doctor_namee'
    ];

	// Example for doctor_name
    public function getDoctorNameeAttribute()
    {
        return $this->employee?->name ?? '-123';
    }
    // Factory (if you use factories)
    // protected static function newFactory(): EmployeeFactory
    // {
    //     return EmployeeFactory::new();
    // }

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
