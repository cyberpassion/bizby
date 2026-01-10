<?php
namespace Modules\Admin\Enums;

enum ChargeType: string
{
    case ONBOARDING = 'onboarding';
    case RENEWAL    = 'renewal';
    case ADDON      = 'addon';
}
