<?php
namespace Modules\Admin\Enums\Tenants;

enum TenantChargeType: string
{
    case ONBOARDING = 'onboarding';
    case RENEWAL    = 'renewal';
    case ADDON      = 'addon';
}
