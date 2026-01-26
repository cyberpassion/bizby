<?php
namespace Modules\Admin\Enums\Tenants;

enum OperationType: string {
    case PROVISION = 'provision';
    case INSTALL   = 'install';
    case ENABLE    = 'enable';
    case DISABLE   = 'disable';
    case UPGRADE   = 'upgrade';
    case REMOVE    = 'remove';
}
