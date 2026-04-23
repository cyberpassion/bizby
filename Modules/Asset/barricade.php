<?php
use Modules\Shared\Support\Permission;
use Modules\Asset\Support\Res;
use Modules\Asset\Support\Actions;

return [
	Permission::make(Res::ASSETS, Actions::CREATE) => [
		[
            'type'     => 'exists',
            'resource' => 'employees',
            'filter'   => ['status'=>true],
            'message'  => 'Please add employee before adding asset.',
            'action'   => '/module/employee/create',
        ],
		[
            'type'     => 'exists',
            'resource' => 'centers',
            'filter'   => ['status'=>true],
            'message'  => 'Please add center before adding asset.',
            'action'   => '/module/center/create',
        ]
	]
];