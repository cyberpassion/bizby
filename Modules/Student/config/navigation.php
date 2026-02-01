<?php

return [

    /* ---------------- Sidebar ---------------- */
    'sidebar' => [
        [
            'title' => 'Dashboard',
            'href'  => '/module/student/home',
            'permission' => 'student.dashboard.view',
        ],
        [
            'title' => 'Students',
            'items' => [
                [
                    'title' => 'Add Student',
                    'href'  => '/module/student/new',
                    'permission' => 'student.student.create',
                ],
                [
                    'title' => 'View List',
                    'href'  => '/module/student/list',
                    'permission' => 'student.student.view',
                ],
            ]
        ],
    ],

    /* ---------------- Module menu ---------------- */
    'module' => [
        [
            'title' => 'Overview',
            'href'  => '/students',
            'permission' => 'student.student.view',
        ],
    ],

    /* ---------------- Item menu ---------------- */
    'item' => [
        'student' => [
            [
                'title' => 'Overview',
                'href'  => '/students/{id}',
                'permission' => 'student.student.view',
            ],
            [
                'title' => 'Edit',
                'href'  => '/students/{id}/edit',
                'permission' => 'student.student.edit',
            ],
        ]
    ]
];
