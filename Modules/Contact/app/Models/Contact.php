<?php

namespace Modules\Contact\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class Contact extends TenantModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    /**
     * Attribute casting.
     */
    protected $casts = [
		'datetime'			=> 'datetime',
        'contact_date' => 'date', // Laravel will cast it to Carbon
    ];

    /**
     * Default attribute values
     */
    protected $attributes = [];

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
    // protected static function newFactory(): ContactFactory
    // {
    //     return ContactFactory::new();
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
