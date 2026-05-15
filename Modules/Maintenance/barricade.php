<?php
use Modules\Shared\Support\Permission;
use Modules\Maintenance\Support\Res;
use Modules\Maintenance\Support\Actions;

return [
	Permission::make(Res::MAINTENANCES, Actions::CREATE) => [
		[
            'type'     => 'exists',
            'resource' => 'centers',
            'filter'   => ['status'=>true],
            'message'  => 'Please add center before proceeding.',
            'action'   => '/module/center/create',
        ]
	]
];