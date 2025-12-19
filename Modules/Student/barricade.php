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
            'action'   => '/module/student/academicyears',
        ],
    ],

	'path.student.list' => [
        [
            'type'     => 'exists',
            'resource' => 'terms',
            'filter'   => ['module' => 'student', 'group' => 'classes'],
            'message'  => 'Please create at least one Class before adding students.',
            'action'   => '/module/shared/terms/student/classes',
        ]
    ],
];
