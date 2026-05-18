<?php

use Modules\Attendance\Support\Actions;
use Modules\Attendance\Support\Res;
use Modules\Shared\Support\KeyName;
use Modules\Shared\Support\Permission;
use Modules\Shared\Support\UrlPath;

$module = 'attendance';

return [

    /*
    |--------------------------------------------------------------------------
    | Sidebar Menu
    |--------------------------------------------------------------------------
    */
    'sidebar-menu' => [
        [
            'title' => ucfirst($module),
            'href' => "/{$module}",
            'permission' => Permission::access($module),

            'items' => [

                [
                    'title' => 'Home',
                    'href' => UrlPath::makeHome($module),
                    'permission' => Permission::view(Res::HOME),
                ],

                [
                    'title' => 'Working Days',
                    'items' => [
                        [
                            'title' => 'Weekly Offs',
                            'href' => UrlPath::make(Res::WEEKLY_OFFS, 'list'),
                            'permission' => Permission::list(Res::WEEKLY_OFFS),
                        ],
                        [
                            'title' => 'Holidays',
                            'href' => UrlPath::make(Res::HOLIDAYS, 'list'),
                            'permission' => Permission::list(Res::HOLIDAYS),
                        ],
                        [
                            'title' => 'Cal. Overrides',
                            'href' => UrlPath::make(Res::CALENDAR_DAYS, 'list'),
                            'permission' => Permission::list(Res::CALENDAR_DAYS),
                        ],
                    ],
                ],

                [
                    'title' => 'Batches',
                    'items' => [
                        [
                            'title' => 'Create Batch',
                            'href' => UrlPath::make(Res::BATCHES, 'create'),
                            'permission' => Permission::create(Res::BATCHES),
                        ],
                        [
                            'title' => 'Batch List',
                            'href' => UrlPath::make(Res::BATCHES, 'list'),
                            'permission' => Permission::list(Res::BATCHES),
                        ],
                    ],
                ],

                [
                    'title' => 'Sessions',
                    'items' => [
                        [
                            'title' => 'Today’s Sessions',
                            'href' => UrlPath::make(Res::SESSIONS, 'today'),
                            'permission' => Permission::make(Res::SESSIONS, Actions::TODAY),
                        ],
                        [
                            'title' => 'Create Session',
                            'href' => UrlPath::make(Res::SESSIONS, 'create'),
                            'permission' => Permission::create(Res::SESSIONS),
                        ],
                        [
                            'title' => 'Session List',
                            'href' => UrlPath::make(Res::SESSIONS, 'list'),
                            'permission' => Permission::list(Res::SESSIONS),
                        ],
                    ],
                ],

                [
                    'title' => 'Schedules',
                    'items' => [
                        [
                            'title' => 'Create Schedule',
                            'href' => UrlPath::make(Res::SCHEDULES, 'create	'),
                            'permission' => Permission::create(Res::SCHEDULES),
                        ],
                        [
                            'title' => 'Schedule List',
                            'href' => UrlPath::make(Res::SCHEDULES, 'list'),
                            'permission' => Permission::list(Res::SCHEDULES),
                        ],
                    ],

                ],

                [
                    'title' => 'Attendance',
                    'items' => [
                        /*[
                            'title'      => 'Mark Attendance',
                            'href'       => UrlPath::make($module, 'mark'),
                            'permission' => Permission::make(Res::ATTENDANCES, Actions::MARK),
                        ],*/
                        [
                            'title' => 'Attendance List',
                            'href' => UrlPath::make($module, 'list'),
                            'permission' => Permission::list(Res::ATTENDANCES),
                        ],
                        [
                            'title' => 'Corrections',
                            'href' => UrlPath::make($module, 'corrections'),
                            'permission' => Permission::make(Res::ATTENDANCES, Actions::CORRECT),
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',

                    'items' => [

                        /*
        |--------------------------------------------------------------------------
        | Generic
        |--------------------------------------------------------------------------
        */

                        [
                            'title' => 'Report',

                            'href' => UrlPath::make(
                                $module,
                                'report'
                            ),

                            'permission' => Permission::view(
                                Res::REPORTS
                            ),
                        ],

                        /*
        |--------------------------------------------------------------------------
        | Daily
        |--------------------------------------------------------------------------
        */

                        [
                            'title' => 'Daily',

                            'href' => UrlPath::make(
                                $module,
                                'report/daily'
                            ),

                            'permission' => Permission::make(
                                Res::REPORTS,
                                Actions::DAILY
                            ),
                        ],

                        /*
        |--------------------------------------------------------------------------
        | Monthly
        |--------------------------------------------------------------------------
        */

                        [
                            'title' => 'Monthly',

                            'href' => UrlPath::make(
                                $module,
                                'report/monthly'
                            ),

                            'permission' => Permission::make(
                                Res::REPORTS,
                                Actions::MONTHLY
                            ),
                        ],

                        /*
        |--------------------------------------------------------------------------
        | Percentage-wise
        |--------------------------------------------------------------------------
        */

                        [
                            'title' => 'Percentage-wise',

                            'href' => UrlPath::make(
                                $module,
                                'report/percentage'
                            ),

                            'permission' => Permission::make(
                                Res::REPORTS,
                                Actions::PERCENTAGE
                            ),
                        ],

                        /*
        |--------------------------------------------------------------------------
        | Entity-wise
        |--------------------------------------------------------------------------
        */

                        [
                            'title' => 'Entity-wise',

                            'href' => UrlPath::make(
                                $module,
                                'report/entity'
                            ),

                            'permission' => Permission::make(
                                Res::REPORTS,
                                Actions::ENTITY
                            ),
                        ],

                        /*
        |--------------------------------------------------------------------------
        | Batch-wise
        |--------------------------------------------------------------------------
        */

                        [
                            'title' => 'Batch-wise',

                            'href' => UrlPath::make(
                                $module,
                                'report/batch'
                            ),

                            'permission' => Permission::make(
                                Res::REPORTS,
                                Actions::BATCH
                            ),
                        ],

                        /*
        |--------------------------------------------------------------------------
        | Session-wise
        |--------------------------------------------------------------------------
        */

                        [
                            'title' => 'Session-wise',

                            'href' => UrlPath::make(
                                $module,
                                'report/session'
                            ),

                            'permission' => Permission::make(
                                Res::REPORTS,
                                Actions::SESSION
                            ),
                        ],

                        /*
        |--------------------------------------------------------------------------
        | Absent
        |--------------------------------------------------------------------------
        */

                        [
                            'title' => 'Absent',

                            'href' => UrlPath::make(
                                $module,
                                'report/absent'
                            ),

                            'permission' => Permission::make(
                                Res::REPORTS,
                                Actions::ABSENT
                            ),
                        ],

                        /*
        |--------------------------------------------------------------------------
        | Late
        |--------------------------------------------------------------------------
        */

                        [
                            'title' => 'Late',

                            'href' => UrlPath::make(
                                $module,
                                'report/late'
                            ),

                            'permission' => Permission::make(
                                Res::REPORTS,
                                Actions::LATE
                            ),
                        ],

                        /*
        |--------------------------------------------------------------------------
        | Defaulter
        |--------------------------------------------------------------------------
        */

                        [
                            'title' => 'Defaulter',

                            'href' => UrlPath::make(
                                $module,
                                'report/defaulter'
                            ),

                            'permission' => Permission::make(
                                Res::REPORTS,
                                Actions::DEFAULTER
                            ),
                        ],

                        /*
        |--------------------------------------------------------------------------
        | Trends
        |--------------------------------------------------------------------------
        */

                        [
                            'title' => 'Trends',

                            'href' => UrlPath::make(
                                $module,
                                'report/trends'
                            ),

                            'permission' => Permission::make(
                                Res::REPORTS,
                                Actions::TRENDS
                            ),
                        ],

                        /*
        |--------------------------------------------------------------------------
        | Analysis
        |--------------------------------------------------------------------------
        */

                        [
                            'title' => 'Analysis',

                            'href' => UrlPath::make(
                                $module,
                                'report/analysis'
                            ),

                            'permission' => Permission::make(
                                Res::REPORTS,
                                Actions::ANALYSIS
                            ),
                        ],
                    ],
                ],

                [
                    'title' => 'Devices & Modes',
                    'items' => [
                        [
                            'title' => 'QR Attendance',
                            'href' => UrlPath::make($module, 'modes/qr'),
                            'permission' => Permission::make(Res::MODES, Actions::QR),
                        ],
                        [
                            'title' => 'Biometric',
                            'href' => UrlPath::make($module, 'modes/biometric'),
                            'permission' => Permission::make(Res::MODES, Actions::BIOMETRIC),
                        ],
                        [
                            'title' => 'RFID / Card',
                            'href' => UrlPath::make($module, 'modes/rfid'),
                            'permission' => Permission::make(Res::MODES, Actions::RFID),
                        ],
                        [
                            'title' => 'Self Attendance',
                            'href' => UrlPath::make($module, 'modes/self'),
                            'permission' => Permission::make(Res::MODES, Actions::SELF),
                        ],
                    ],
                ],

                /*[
                    'title' => 'Configuration',
                    'items' => [
                        [
                            'title'      => 'Session Types',
                            'href'       => UrlPath::make($module, 'session-types'),
                            'permission' => Permission::update(Res::SESSION_TYPES),
                        ],
                        [
                            'title'      => 'Rules',
                            'href'       => UrlPath::make($module, 'rules'),
                            'permission' => Permission::update(Res::RULES),
                        ],
                        [
                            'title'      => 'Statuses-Codes',
                            'href'       => UrlPath::make($module, 'statuses'),
                            'permission' => Permission::update(Res::STATUSES),
                        ],
                    ],
                ],*/

                [
                    'title' => 'Settings',
                    'href' => UrlPath::makeSettings($module),
                    'permission' => Permission::update(Res::SETTINGS),
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Row Actions
    |--------------------------------------------------------------------------
    */
    'single-actions' => [

        KeyName::make(Res::WEEKLY_OFFS) => [
            Actions::LIST => [
                [
                    'title' => 'Update',
                    'href' => UrlPath::makeUpdate(Res::WEEKLY_OFFS, '{id}'),
                    'permission' => Permission::update(Res::WEEKLY_OFFS),
                    'action' => 'update',
                    'icon' => 'update',
                ],
                [
                    'title' => 'Delete',
                    'href' => UrlPath::makeDelete(Res::WEEKLY_OFFS, '{id}'),
                    'permission' => Permission::delete(Res::WEEKLY_OFFS),
                    'action' => 'delete',
                    'method' => 'DELETE',
                    'variant' => 'danger',
                    'icon' => 'delete',
                ],
            ],
        ],
        KeyName::make(Res::HOLIDAYS) => [
            Actions::LIST => [
                [
                    'title' => 'Update',
                    'href' => UrlPath::makeUpdate(Res::HOLIDAYS, '{id}'),
                    'permission' => Permission::update(Res::HOLIDAYS),
                    'action' => 'update',
                    'icon' => 'update',
                ],
                [
                    'title' => 'Delete',
                    'href' => UrlPath::makeDelete(Res::HOLIDAYS, '{id}'),
                    'permission' => Permission::delete(Res::HOLIDAYS),
                    'action' => 'delete',
                    'method' => 'DELETE',
                    'variant' => 'danger',
                    'icon' => 'delete',
                ],
            ],
        ],
        KeyName::make(Res::CALENDAR_DAYS) => [
            Actions::LIST => [
                [
                    'title' => 'Update',
                    'href' => UrlPath::makeUpdate(Res::CALENDAR_DAYS, '{id}'),
                    'permission' => Permission::update(Res::CALENDAR_DAYS),
                    'action' => 'update',
                    'icon' => 'update',
                ],
                [
                    'title' => 'Delete',
                    'href' => UrlPath::makeDelete(Res::CALENDAR_DAYS, '{id}'),
                    'permission' => Permission::delete(Res::CALENDAR_DAYS),
                    'action' => 'delete',
                    'method' => 'DELETE',
                    'variant' => 'danger',
                    'icon' => 'delete',
                ],
            ],
        ],
        KeyName::make(Res::SCHEDULES) => [
            Actions::LIST => [
                [
                    'title' => 'Generate Sessions',
                    'href' => '#', // UrlPath::make($module, Actions::GENERATE . '/{id}'),
                    'permission' => Permission::view(Res::SCHEDULES),
                    'action' => 'custom',
                    'method' => 'POST',
                    'custom' => [
                        'apiEndpoint' => 'attendance/schedules/{id}/generate-sessions',
                        'successMessage' => 'Sessions generated successfully.',
                        'errorMessage' => 'Failed to generate sessions.',
                    ],
                    'variant' => 'success',
                ],

                [
                    'title' => 'Update',
                    'href' => UrlPath::makeUpdate(Res::SCHEDULES, '{id}'),
                    'permission' => Permission::update(Res::SCHEDULES),
                    'action' => 'update',
                    'icon' => 'update',
                ],

                [
                    'title' => 'Delete',
                    'href' => UrlPath::makeDelete(Res::SCHEDULES, '{id}'),
                    'permission' => Permission::delete(Res::SCHEDULES),
                    'action' => 'delete',
                    'method' => 'DELETE',
                    'variant' => 'danger',
                    'icon' => 'delete',
                ],
            ],
        ],
        KeyName::make(Res::BATCHES) => [
            Actions::LIST => [
                [
                    'title' => 'Update',
                    'href' => UrlPath::makeUpdate(Res::BATCHES, '{id}'),
                    'permission' => Permission::update(Res::BATCHES),
                    'action' => 'update',
                    'icon' => 'update',
                ],

                [
                    'title' => 'Add Participants',
                    'href' => UrlPath::make(Res::BATCHES, '{id}/participants'),
                    'permission' => Permission::update(Res::BATCHES),
                    'action' => 'update',
                    'icon' => 'add',
                ],

                [
                    'title' => 'Delete',
                    'href' => UrlPath::makeDelete(Res::BATCHES, '{id}'),
                    'permission' => Permission::delete(Res::BATCHES),
                    'action' => 'delete',
                    'method' => 'DELETE',
                    'variant' => 'danger',
                    'icon' => 'delete',
                ],
            ],
        ],
        KeyName::make(Res::SESSIONS) => [
            Actions::LIST => [
                [
                    'title' => 'Mark Attendance',
                    'href' => UrlPath::make($module, 'mark/session/{id}'),
                    'permission' => Permission::make(Res::ATTENDANCES, Actions::MARK),
                ],
                [
                    'title' => 'Update',
                    'href' => UrlPath::make($module, 'sessions/update/{id}'),
                    'permission' => Permission::update(Res::SESSIONS),
                    'action' => 'update',
                    'icon' => 'update',
                ],
                [
                    'title' => 'View Details',
                    'href' => UrlPath::make($module, 'sessions/{id}'),
                    'permission' => Permission::view(Res::SESSIONS),
                    'action' => 'view',
                    'icon' => 'view',
                ],
                [
                    'title' => 'Delete',
                    'href' => UrlPath::makeDelete(Res::SESSIONS, '{id}'),
                    'permission' => Permission::delete(Res::SESSIONS),
                    'action' => 'delete',
                    'method' => 'DELETE',
                    'variant' => 'danger',
                    'icon' => 'delete',
                ],
            ],
        ],
        KeyName::make(Res::ATTENDANCES) => [],
        KeyName::make(Actions::LIST) => [],

    ],

    /*
    |--------------------------------------------------------------------------
    | List Filters
    |--------------------------------------------------------------------------
    */
    'filters' => [

        KeyName::make(Res::WEEKLY_OFFS) => [],
        KeyName::make(Res::HOLIDAYS) => [],
        KeyName::make(Res::CALENDAR_DAYS) => [],
        KeyName::make(Res::SCHEDULES) => [],
        KeyName::make(Res::BATCHES) => [],
        KeyName::make(Res::BATCH_PARTICIPANTS) => [],
        KeyName::make(Res::SESSIONS) => [],
        KeyName::make(Actions::LIST) => [

            [
                'type' => 'select',
                'name' => 'session',
                'placeholder' => 'Session',
                'col' => 3,
                'dataKey' => 'attendance.session',
            ],
            [
                'type' => 'select',
                'name' => 'month',
                'placeholder' => 'Month',
                'col' => 3,
                'dataKey' => 'attendance.month',
            ],
            [
                'type' => 'select',
                'name' => 'is_paid',
                'placeholder' => 'Paid / Unpaid',
                'col' => 3,
                'dataKey' => 'attendance.paid_unpaid',
            ],
            [
                'type' => 'date:Y-m-d',
                'name' => 'absent_date',
                'placeholder' => 'Absent Date',
                'col' => 3,
            ],
        ],

    ],

];
