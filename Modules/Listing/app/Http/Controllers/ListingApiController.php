<?php

namespace Modules\Listing\Http\Controllers;

use Modules\Listing\Models\Listing;
use Modules\Shared\Http\Controllers\SharedApiController;

class ListingApiController extends SharedApiController
{
    protected function model()
    {
        return Listing::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}
