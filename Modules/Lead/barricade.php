<?php
use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\Permission;
use Modules\Lead\Support\Res;
use Modules\Lead\Support\Actions;

return [
	Permission::make(Res::LEADS, Actions::CREATE) => [
		[
            'type'     => 'exists',
            'resource' => 'terms',
            'filter'   => ['module' => 'lead', 'group' => 'lead-categories'],
            'message'  => 'Please create at least one category before proceeding.',
            'action'   => UrlPath::make('shared/terms', 'lead/lead-categories')
        ],
		[
            'type'     => 'exists',
            'resource' => 'employees',
            'filter'   => ['status'=>true],
            'message'  => 'Please add employee before adding proceeding.',
            'action'   => UrlPath::make('employee', Actions::CREATE),
        ]
	]
];