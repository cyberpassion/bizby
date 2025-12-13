<?php

namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Models\TenantUser;
use Modules\Shared\Http\Controllers\SharedChildApiController;

class TenantUserController extends SharedChildApiController
{
    protected function parentModel()
    {
        return \Modules\Admin\Models\Tenant::class;
    }

    protected function childModel()
    {
        return \Modules\Admin\Models\TenantUser::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }

}
