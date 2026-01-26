<?php
namespace Modules\Booking\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class BookableUnit extends TenantModel
{

	use HasFactory;

    protected $fillable = [];

    protected $casts = [
        'meta' => 'array',
        'status' => 'boolean',
    ];

    public function venue()
    {
        return $this->belongsTo(BookingVenue::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

	public function pricings()
    {
        return $this->hasMany(
            BookingUnitPricing::class,
            'bookable_unit_id'
        );
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
