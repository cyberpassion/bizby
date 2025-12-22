<?php
return [
    'path.consultation.create' => [
        [
            'type'     => 'exists',
            'resource' => 'employees',
            'filter'   => ['status'=>true],
            'message'  => 'Please add employee before adding consultation.',
            'action'   => '/module/employee/create',
        ]
    ]

];
