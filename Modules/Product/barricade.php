<?php
return [
    'path.product.create' => [
		[
            'type'     => 'exists',
            'resource' => 'terms',
            'filter'   => ['module'=>'product','group'=>'product-types'],
            'message'  => 'Please add types before adding proceeding.',
            'action'   => '/module/shared/terms/product/product-types',
        ],
		[
            'type'     => 'exists',
            'resource' => 'terms',
            'filter'   => ['module'=>'product','group'=>'brand-names'],
            'message'  => 'Please add brand names before adding proceeding.',
            'action'   => '/module/shared/terms/product/brand-names',
        ]
	],
	'path.product.read' => [],
	'path.product.update' => [],
	'path.product.delete' => [],
	'path.product.list' => [],
	'path.product.document' => [],
];