<?php

namespace Modules\Booking\Http\Controllers;

use Modules\Booking\Models\Booking;
use Modules\Shared\Http\Controllers\SharedApiController;

class BookingApiController extends SharedApiController
{
    protected function model()
    {
        return Booking::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}
