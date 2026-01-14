<?php
namespace Modules\Admin\Events;

class TenantActivated
{
    public function __construct(
        public int $tenantId
    ) {}
}
