<?php

namespace Modules\Listing\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingEvent extends Model
{
    use HasFactory;

	protected $connection = 'central';

    protected $fillable = [
        'listing_id',
        'event_type',
        'session_id',
        'ip',
        'user_agent',
        'user_id',
        'source',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}