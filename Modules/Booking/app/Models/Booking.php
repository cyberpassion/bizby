<?php
namespace Modules\Booking\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class Booking extends TenantModel
{

	use HasFactory;

    protected $fillable = [];

    protected $casts = [
        'meta' => 'array',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function venue()
    {
        return $this->belongsTo(BookingVenue::class);
    }

    public function unit()
    {
        return $this->belongsTo(BookableUnit::class, 'bookable_unit_id');
    }

    public function bookedBy()
    {
        return $this->morphTo();
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
