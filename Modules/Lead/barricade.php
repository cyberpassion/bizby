<?php
return [
    'path.lead.create' => [
		[
            'type'     => 'exists',
            'resource' => 'terms',
            'filter'   => ['module' => 'lead', 'group' => 'lead-categories'],
            'message'  => 'Please create at least one category before proceeding.',
            'action'   => '/module/shared/terms/lead/lead-categories',
        ],
		[
            'type'     => 'exists',
            'resource' => 'employees',
            'filter'   => ['status'=>true],
            'message'  => 'Please add employee before adding proceeding.',
            'action'   => '/module/employee/new',
        ]
	],
	'path.lead.read' => [],
	'path.lead.update' => [],
	'path.lead.delete' => [],
	'path.lead.list' => [],
	'path.lead.document' => [],
];