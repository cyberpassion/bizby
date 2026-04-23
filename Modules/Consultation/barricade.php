<?php
use Modules\Shared\Support\Permission;
use Modules\Consultation\Support\Res;
use Modules\Consultation\Support\Actions;

return [
	Permission::make(Res::CONSULTATIONS, Actions::CREATE) => [
		[
            'type'     => 'exists',
            'resource' => 'employees',
            'filter'   => ['status'=>true],
            'message'  => 'Please add employee before adding consultation.',
            'action'   => '/module/employee/create',
        ]
	]
];