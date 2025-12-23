<?php

namespace Modules\Booking\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingUnitPricing extends Model
{
    use HasFactory;

    protected $table = 'booking_unit_pricings';

    protected $fillable = [];

    /* ---------------- Relations ---------------- */

    public function unit()
    {
        return $this->belongsTo(BookableUnit::class, 'bookable_unit_id');
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
