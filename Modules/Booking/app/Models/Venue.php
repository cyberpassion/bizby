<?php
namespace Modules\Booking\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = [
        'organization_id',
        'name',
        'type',
        'address',
        'city',
        'state',
        'country',
        'meta',
        'is_active',
    ];

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
}
