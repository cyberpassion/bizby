<?php

namespace Modules\Product\Http\Controllers;

use Modules\Product\Models\Product;
use Modules\Shared\Http\Controllers\SharedApiController;

class ProductApiController extends SharedApiController
{
    protected function model()
    {
        return Product::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}
