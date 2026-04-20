<?php
use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\Permission;
use Modules\Lead\Support\Res;
use Modules\Lead\Support\Actions;

return [
	Permission::make(Res::LEADS, Actions::CREATE) => [
		[
            'type'     => 'exists',
            'resource' => 'employees',
            'filter'   => ['status'=>true],
            'message'  => 'Please add employee before adding proceeding.',
            'action'   => UrlPath::make('employee', Actions::CREATE),
        ]
	]
];