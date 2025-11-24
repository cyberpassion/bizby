<?php

namespace Modules\Transport\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class TransportVehicleStoppage extends Model
{
    use HasFactory;

    protected $connection = 'mysql'; // Always use mysql connection

	// Specify the custom table name
    protected $table = 'cyp_transport_vehicle_stoppage';

	// Specify custom primary key
	//protected $primaryKey = 'transport_id';

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
        'transport_date' => 'date', // Laravel will cast it to Carbon
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
    // protected static function newFactory(): TransportFactory
    // {
    //     return TransportFactory::new();
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
