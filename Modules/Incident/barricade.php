<?php
use Modules\Shared\Support\Permission;
use Modules\Incident\Support\Res;
use Modules\Incident\Support\Actions;

return [
	Permission::make(Res::INCIDENTS, Actions::CREATE) => [
		[
            'type'     => 'exists',
            'resource' => 'centers',
            'filter'   => ['status'=>true],
            'message'  => 'Please add center before proceeding.',
            'action'   => '/module/center/create',
        ]
	]
];