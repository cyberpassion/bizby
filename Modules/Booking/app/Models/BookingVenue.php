<?php
namespace Modules\Booking\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class BookingVenue extends Model
{

	use HasFactory;

    protected $fillable = [];

    protected $casts = [
        'meta' => 'array',
        'is_active' => 'boolean',
    ];

    public function units()
    {
        return $this->hasMany(BookableUnit::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
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
