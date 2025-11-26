<?php

namespace Modules\Vendor\Http\Controllers;

use Modules\Vendor\Models\Vendor;
use Modules\Shared\Http\Controllers\SharedApiController;

class VendorApiController extends SharedApiController
{
    protected function model()
    {
        return Vendor::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}
