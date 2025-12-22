<?php

namespace Modules\Booking\Http\Controllers;

use Modules\Booking\Models\BookingVenue;
use Modules\Shared\Http\Controllers\SharedApiController;

class BookingVenueApiController extends SharedApiController
{
    protected function model()
    {
        return BookingVenue::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}
