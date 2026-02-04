<?php
$pg = 'leaveapplication';
$commonSettingsRoute = '/settings';

return [

    /* =========================
     | Sidebar Menu (UI)
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
                    'title' => 'Leaves',
                    'items' => [
                        [
                            'title'      => 'Add Leave',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.leave.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.leave.view",
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Leave Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.leave",
                        ],
                    ],
                ],

                [
                    'title' => 'Settings',
                    'items' => [
                        [
                            'title'      => 'Basic Settings',
                            'href'       => "/module/{$pg}/settings",
                            'permission' => "{$pg}.settings.basic",
                        ],
                    ],
                ],

                [
                    'title' => 'Plugins',
                    'items' => [
                        [
                            'title'      => 'View Calendar',
                            'href'       => "/plugin/calendar?module={$pg}",
                            'permission' => "{$pg}.plugin.manage",
                        ],
                    ],
                ],
            ],
        ],
    ],

    /* =========================
     | UI Columns / Filters
     ========================= */
    'leaveapplication.list-columns' => [
        'leaveapplication_id',
        'applicant',
        'session',
        'leave_date',
        'leave_type',
        'leave_duration',
    ],

    'leaveapplication.list-filters-ui' => [
        'applicant_id',
        'leave_type',
        'leave_date',
        'session',
        'month',
    ],

    'leaveapplication.report-columns' => [
        'leaveapplication_id',
        'applicant',
        'applicant_type',
        'session',
        'month',
        'leave_date',
        'leave_date_part',
        'leave_duration',
        'leave_duration_part',
        'leave_type',
        'leave_reason',
        'hr_response_remark',
    ],

];
