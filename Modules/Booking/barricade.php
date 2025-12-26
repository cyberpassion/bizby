<?php
return [
    'path.booking.create' => [],
	'path.booking.read' => [],
	'path.booking.update' => [],
	'path.booking.delete' => [],
	'path.booking.list' => [],
	'path.booking.document' => [],

	'path.booking.venue.create' => [],
	'path.booking.venue.read' => [],
	'path.booking.venue.update' => [],
	'path.booking.venue.delete' => [],
	'path.booking.venue.list' => [],
	'path.booking.venue.document' => [],

	'path.booking.unit.create' => [
		[
            'type'     => 'exists',
            'resource' => 'bookings-venue',
            'filter'   => ['status'=>true],
            'message'  => 'Please add venue before proceeding.',
            'action'   => '/module/booking/new-venue',
        ]
	],
	'path.booking.unit.read' => [],
	'path.booking.unit.update' => [],
	'path.booking.unit.delete' => [],
	'path.booking.unit.list' => [],
	'path.booking.unit.document' => [],

	'path.booking.pricing.create' => [
		[
            'type'     => 'exists',
            'resource' => 'bookings-venue',
            'filter'   => ['status'=>true],
            'message'  => 'Please add venue before proceeding.',
            'action'   => '/module/booking/new-venue',
        ],
		[
            'type'     => 'exists',
            'resource' => 'bookings-unit',
            'filter'   => ['status'=>true],
            'message'  => 'Please add bookable unit before proceeding.',
            'action'   => '/module/booking/new-unit',
        ]
	],
	'path.booking.pricing.read' => [],
	'path.booking.pricing.update' => [],
	'path.booking.pricing.delete' => [],
	'path.booking.pricing.list' => [],
	'path.booking.pricing.document' => [],
];