<?php
namespace Modules\Booking\Models;

use Illuminate\Database\Eloquent\Model;

class BookableUnit extends Model
{
    protected $fillable = [
        'venue_id',
        'name',
        'unit_type',
        'capacity',
        'code',
        'meta',
        'is_active',
    ];

    protected $casts = [
        'meta' => 'array',
        'is_active' => 'boolean',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
