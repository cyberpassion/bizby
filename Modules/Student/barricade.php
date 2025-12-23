<?php
return [
    'path.student.create' => [
        [
            'type'     => 'exists',
            'resource' => 'terms',
            'filter'   => ['module' => 'student', 'group' => 'classes'],
            'message'  => 'Please create at least one Class before adding students.',
            'action'   => '/module/shared/terms/student/classes',
        ],
		[
            'type'     => 'exists',
            'resource' => 'terms',
            'filter'   => ['module' => 'student', 'group' => 'sections'],
            'message'  => 'Please create at least one Section before adding students.',
            'action'   => '/module/shared/terms/student/sections',
        ],
        [
            'type'     => 'exists',
            'resource' => 'academic_years',
            'filter'   => ['is_active' => true, 'is_locked' => false],
            'message'  => 'Please create an Academic Year before adding students.',
            'action'   => '/module/student/academic-years',
        ],
    ],

	'path.student.list' => [
        [
            'type'     => 'exists',
            'resource' => 'terms',
            'filter'   => ['module' => 'student', 'group' => 'classes'],
            'message'  => 'Please create at least one Class before adding students.',
            'action'   => '/module/shared/terms/student/classes',
        ],
		[
            'type'     => 'exists',
            'resource' => 'terms',
            'filter'   => ['module' => 'student', 'group' => 'sections'],
            'message'  => 'Please create at least one Section before adding students.',
            'action'   => '/module/shared/terms/student/sections',
        ],
        [
            'type'     => 'exists',
            'resource' => 'academic_years',
            'filter'   => ['is_active' => true, 'is_locked' => false],
            'message'  => 'Please create an Academic Year before adding students.',
            'action'   => '/module/student/academic-years',
        ],
    ],

	'path.student.fee-structure' => [
        [
            'type'     => 'exists',
            'resource' => 'terms',
            'filter'   => ['module' => 'student', 'group' => 'fee-heads'],
            'message'  => 'Please create at least one Fee Head before adding fee structure.',
            'action'   => '/module/shared/terms/student/fee-heads',
        ]
    ]

];
