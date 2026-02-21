<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\Permission;
use Modules\Attendance\Support\Res;
use Modules\Attendance\Support\Actions;

$pg = 'attendance';

return [

    /*
    |--------------------------------------------------------------------------
    | Sidebar Menu
    |--------------------------------------------------------------------------
    */
    'sidebar-menu' => [
        [
            'title'      => ucfirst($pg),
            'href'       => "/{$pg}",
            'permission' => Permission::access($pg),

            'items' => [

                [
                    'title'      => 'Dashboard',
                    'href'       => UrlPath::makeHome($pg),
                    'permission' => Permission::view(Res::HOME),
                ],

                [
                    'title' => 'Working Days',
                    'items' => [
                        [
                            'title'      => 'Weekly Offs',
                            'href'       => UrlPath::make($pg, 'config/weekly-offs'),
                            'permission' => Permission::list(Res::WEEKLY_OFFS),
                        ],
                        [
                            'title'      => 'Holidays',
                            'href'       => UrlPath::make($pg, 'config/holidays'),
                            'permission' => Permission::list(Res::HOLIDAYS),
                        ],
                        [
                            'title'      => 'Cal. Overrides',
                            'href'       => UrlPath::make($pg, 'config/calendar-days'),
                            'permission' => Permission::list(Res::CALENDAR_DAYS),
                        ],
                    ],
                ],

                [
                    'title' => 'Automation',
                    'items' => [
                        [
                            'title'      => 'Schedules',
                            'href'       => UrlPath::make($pg, 'config/schedules'),
                            'permission' => Permission::list(Res::SCHEDULES),
                        ],
                    ],
                ],

                [
                    'title' => 'Sessions',
                    'items' => [
                        [
                            'title'      => 'Create Session',
                            'href'       => UrlPath::make($pg, 'sessions/create'),
                            'permission' => Permission::create(Res::SESSIONS),
                        ],
                        [
                            'title'      => 'Session List',
                            'href'       => UrlPath::make($pg, 'sessions'),
                            'permission' => Permission::list(Res::SESSIONS),
                        ],
                        [
                            'title'      => 'Today’s Sessions',
                            'href'       => UrlPath::make($pg, 'sessions/today'),
                            'permission' => Permission::make(Res::SESSIONS, Actions::TODAY),
                        ],
                    ],
                ],

                [
                    'title' => 'Attendance',
                    'items' => [
                        [
                            'title'      => 'Mark Attendance',
                            'href'       => UrlPath::make($pg, 'attendance/mark'),
                            'permission' => Permission::make(Res::ATTENDANCES, Actions::MARK),
                        ],
                        [
                            'title'      => 'Attendance List',
                            'href'       => UrlPath::make($pg, 'attendance'),
                            'permission' => Permission::list(Res::ATTENDANCES),
                        ],
                        [
                            'title'      => 'Corrections',
                            'href'       => UrlPath::make($pg, 'attendance/corrections'),
                            'permission' => Permission::make(Res::ATTENDANCES, Actions::CORRECT),
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Daily',
                            'href'       => UrlPath::make($pg, 'reports/daily'),
                            'permission' => Permission::make(Res::REPORTS, Actions::DAILY),
                        ],
                        [
                            'title'      => 'Monthly',
                            'href'       => UrlPath::make($pg, 'reports/monthly'),
                            'permission' => Permission::make(Res::REPORTS, Actions::MONTHLY),
                        ],
                        [
                            'title'      => 'Entity-wise',
                            'href'       => UrlPath::make($pg, 'reports/entity'),
                            'permission' => Permission::make(Res::REPORTS, Actions::ENTITY),
                        ],
                        [
                            'title'      => 'Analysis',
                            'href'       => UrlPath::make($pg, 'reports/analysis'),
                            'permission' => Permission::make(Res::REPORTS, Actions::ANALYSIS),
                        ],
                    ],
                ],

                [
                    'title' => 'Devices & Modes',
                    'items' => [
                        [
                            'title'      => 'QR Attendance',
                            'href'       => UrlPath::make($pg, 'modes/qr'),
                            'permission' => Permission::make(Res::MODES, Actions::QR),
                        ],
                        [
                            'title'      => 'Biometric',
                            'href'       => UrlPath::make($pg, 'modes/biometric'),
                            'permission' => Permission::make(Res::MODES, Actions::BIOMETRIC),
                        ],
                        [
                            'title'      => 'RFID / Card',
                            'href'       => UrlPath::make($pg, 'modes/rfid'),
                            'permission' => Permission::make(Res::MODES, Actions::RFID),
                        ],
                        [
                            'title'      => 'Self Attendance',
                            'href'       => UrlPath::make($pg, 'modes/self'),
                            'permission' => Permission::make(Res::MODES, Actions::SELF),
                        ],
                    ],
                ],

                [
                    'title' => 'Configuration',
                    'items' => [
                        [
                            'title'      => 'Session Types',
                            'href'       => UrlPath::make($pg, 'config/session-types'),
                            'permission' => Permission::update(Res::SESSION_TYPES),
                        ],
                        [
                            'title'      => 'Rules',
                            'href'       => UrlPath::make($pg, 'config/rules'),
                            'permission' => Permission::update(Res::RULES),
                        ],
                        [
                            'title'      => 'Statuses-Codes',
                            'href'       => UrlPath::make($pg, 'config/statuses'),
                            'permission' => Permission::update(Res::STATUSES),
                        ],
                    ],
                ],

                [
                    'title' => 'Settings',
                    'items' => [
                        [
                            'title'      => 'Basic Settings',
                            'href'       => UrlPath::makeSettings($pg),
                            'permission' => Permission::update(Res::SETTINGS),
                        ],
                        [
                            'title'      => 'Permissions',
                            'href'       => UrlPath::make($pg, 'settings/permissions'),
                            'permission' => Permission::update(Res::SETTINGS),
                        ],
                    ],
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | List Filters
    |--------------------------------------------------------------------------
    */
    'filters' => [

        Actions::LIST => [

            [
                'type'        => 'select',
                'name'        => 'session',
                'placeholder' => 'Session',
                'col'         => 3,
                'dataKey'     => 'attendance.session',
            ],
            [
                'type'        => 'select',
                'name'        => 'month',
                'placeholder' => 'Month',
                'col'         => 3,
                'dataKey'     => 'attendance.month',
            ],
            [
                'type'        => 'select',
                'name'        => 'is_paid',
                'placeholder' => 'Paid / Unpaid',
                'col'         => 3,
                'dataKey'     => 'attendance.paid_unpaid',
            ],
            [
                'type'        => 'date',
                'name'        => 'absent_date',
                'placeholder' => 'Absent Date',
                'col'         => 3,
            ],
        ],

    ],

];
