<?php

namespace Modules\Vendor\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class Vendor extends TenantModel
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
        'vendor_date' => 'date:Y-m-d', // Laravel will cast it to Carbon
    ];

	/* ======================================================
	 | AUTO GENERATE VENDOR CODE
	 ====================================================== */
	protected static function boot()
	{
    	parent::boot();

	    static::creating(function ($vendor) {

	        if (!$vendor->vendor_code) {

	            $year = date('Y');

    	        $last = self::whereYear('created_at', $year)
        	        ->orderBy('id', 'desc')
            	    ->first();

	            $next = 1;

	            if ($last && $last->vendor_code) {
     	           preg_match('/\d+$/', $last->vendor_code, $matches);
        	        $next = isset($matches[0]) ? (int)$matches[0] + 1 : 1;
            	}

	            $vendor->vendor_code = 'VND-' . $year . '-' . str_pad($next, 4, '0', STR_PAD_LEFT);
    	    }
    	});
	}

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
    // protected static function newFactory(): VendorFactory
    // {
    //     return VendorFactory::new();
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
