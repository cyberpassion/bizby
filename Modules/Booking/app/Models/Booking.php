<?php
namespace Modules\Booking\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'venue_id',
        'bookable_unit_id',
        'booking_type',
        'start_at',
        'end_at',
        'status',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function unit()
    {
        return $this->belongsTo(BookableUnit::class, 'bookable_unit_id');
    }

    public function bookedBy()
    {
        return $this->morphTo();
    }
}
