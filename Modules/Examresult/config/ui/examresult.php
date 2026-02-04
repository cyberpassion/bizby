<?php
$pg = 'examresult';
$commonSettingsRoute = '/settings';

return [

    /* =========================
     | Sidebar / UI Menu
     ========================= */
    'sidebar-menu' => [
        [
            'title'      => ucfirst($pg),
            'href'       => "/{$pg}",
            'permission' => "{$pg}.access",
            'items'      => [

                [
                    'title'      => 'Dashboard',
                    'href'       => "/module/{$pg}/home",
                    'permission' => "{$pg}.dashboard.view",
                ],

                [
                    'title' => 'Exam Results',
                    'items' => [
                        [
                            'title'      => 'Add Result',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.result.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.result.view",
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Result Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.result",
                        ],
                    ],
                ],

                [
                    'title' => 'Settings',
                    'items' => [
                        [
                            'title'      => 'Result Settings',
                            'href'       => "/module/{$pg}/settings",
                            'permission' => "{$pg}.settings.manage",
                        ],
                    ],
                ],

                [
                    'title' => 'Plugins',
                    'items' => [
                        [
                            'title'      => 'Calendar View',
                            'href'       => "/module/{$pg}/plugin/calendar",
                            'permission' => "{$pg}.plugin.calendar",
                        ],
                    ],
                ],
            ],
        ],
    ],

    /* =========================
     | UI Tables / Columns
     ========================= */
    'examresult.list-columns' => [
        'id',
        'exam_session',
        'exam_name',
        'exam_class',
        'exam_type',
        'announcement_datetime',
    ],

    'examresult.list-filters-ui' => [
        'exam_session',
        'exam_class',
        'exam_section',
        'exam_type',
        'announcement_datetime',
    ],

    'examresult.report-columns' => [
        'id',
        'exam_session',
        'exam_name',
        'exam_class',
        'exam_section',
        'exam_type',
        'examinee_id_type',
        'announcement_datetime',
        'exam_options',
        'remark',
        'status',
    ],

];
