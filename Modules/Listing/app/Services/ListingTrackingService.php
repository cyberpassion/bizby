<?php

namespace Modules\Listing\Services;

use Modules\Listing\Models\ListingEvent;

class ListingTrackingService
{
    public static function track($listingId, $type)
    {
        ListingEvent::create([
            'listing_id' => $listingId,
            'event_type' => $type,
            'session_id' => session()->getId(),
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'user_id' => auth()->id(),
        ]);
    }
}