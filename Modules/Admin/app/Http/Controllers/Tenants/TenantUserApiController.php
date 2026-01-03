<?php

namespace Modules\Admin\Http\Controllers\Tenants;

use \Modules\Admin\Models\Tenants\TenantAccount;
use Modules\Admin\Models\Tenants\TenantUser;
use Modules\Shared\Http\Controllers\SharedChildApiController;

class TenantUserApiController extends SharedChildApiController
{
    protected function parentModel()
    {
        return TenantAccount::class;
    }

    protected function childModel()
    {
        return TenantUser::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }

}
