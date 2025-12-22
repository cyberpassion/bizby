<?php
return [
    'path.patient.create' => [
		[
            'type'     => 'exists',
            'resource' => 'employees',
            'filter'   => ['status'=>true],
            'message'  => 'Please add employee before adding proceeding.',
            'action'   => '/module/employee/new',
        ]
	],
	'path.patient.read' => [],
	'path.patient.update' => [],
	'path.patient.delete' => [],
	'path.patient.list' => [],
	'path.patient.document' => [],
];