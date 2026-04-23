<?php
return [
    'path.visitplanner.create' => [
		[
            'type'     => 'exists',
            'resource' => 'products',
            'filter'   => ['status'=>true],
            'message'  => 'Please add products before adding proceeding.',
            'action'   => '/module/product/create',
        ]
	],
	'path.visitplanner.read' => [],
	'path.visitplanner.update' => [],
	'path.visitplanner.delete' => [],
	'path.visitplanner.list' => [],
	'path.visitplanner.document' => [],
];