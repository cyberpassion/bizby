<?php
namespace Modules\Admin\Enums\Tenants;

enum TargetType: string {
    case TENANT = 'tenant';
    case MODULE = 'module';
    case ADDON  = 'addon';
    case PLAN   = 'plan';
    case FEATURE= 'feature';
}
