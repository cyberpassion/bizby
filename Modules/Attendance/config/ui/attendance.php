<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\KeyName;
use Modules\Shared\Support\Permission;
use Modules\Attendance\Support\Res;
use Modules\Attendance\Support\Actions;

$module = 'attendance';

return [

    /*
    |--------------------------------------------------------------------------
    | Sidebar Menu
    |--------------------------------------------------------------------------
    */
    'sidebar-menu' => [
        [
            'title'      => ucfirst($module),
            'href'       => "/{$module}",
            'permission' => Permission::access($module),

            'items' => [

                [
                    'title'      => 'Dashboard',
                    'href'       => UrlPath::makeHome($module),
                    'permission' => Permission::view(Res::HOME),
                ],

                [
                    'title' => 'Working Days',
                    'items' => [
                        [
                            'title'      => 'Weekly Offs',
                            'href'       => UrlPath::make($module, 'config/weekly-offs'),
                            'permission' => Permission::list(Res::WEEKLY_OFFS),
                        ],
                        [
                            'title'      => 'Holidays',
                            'href'       => UrlPath::make($module, 'config/holidays'),
                            'permission' => Permission::list(Res::HOLIDAYS),
                        ],
                        [
                            'title'      => 'Cal. Overrides',
                            'href'       => UrlPath::make($module, 'config/calendar-days'),
                            'permission' => Permission::list(Res::CALENDAR_DAYS),
                        ],
                    ],
                ],

				[
				    'title' => 'Batches',
				    'items' => [
        				[
			        	    'title'      => 'Create Batch',
            				'href'       => UrlPath::make($module, 'batches/create'),
			            	'permission' => Permission::create(Res::BATCHES),
        				],
						[
	            			'title'      => 'Batch List',
				            'href'       => UrlPath::make($module, 'batches'),
        	    			'permission' => Permission::list(Res::BATCHES),
				        ],
    				],
				],

                [
                    'title' => 'Sessions',
                    'items' => [
						[
                            'title'      => 'Today’s Sessions',
                            'href'       => UrlPath::make($module, 'sessions/today'),
                            'permission' => Permission::make(Res::SESSIONS, Actions::TODAY),
                        ],
                        [
                            'title'      => 'Create Session',
                            'href'       => UrlPath::make($module, 'sessions/create'),
                            'permission' => Permission::create(Res::SESSIONS),
                        ],
                        [
                            'title'      => 'Session List',
                            'href'       => UrlPath::make($module, 'sessions'),
                            'permission' => Permission::list(Res::SESSIONS),
                        ],
						[
                            'title'      => 'Schedules',
                            'href'       => UrlPath::make($module, 'sessions/schedules'),
                            'permission' => Permission::list(Res::SCHEDULES),
                        ],
                    ],
                ],

                [
                    'title' => 'Attendance',
                    'items' => [
                        [
                            'title'      => 'Mark Attendance',
                            'href'       => UrlPath::make($module, 'mark'),
                            'permission' => Permission::make(Res::ATTENDANCES, Actions::MARK),
                        ],
                        [
                            'title'      => 'Attendance List',
                            'href'       => UrlPath::make($module, 'list'),
                            'permission' => Permission::list(Res::ATTENDANCES),
                        ],
                        [
                            'title'      => 'Corrections',
                            'href'       => UrlPath::make($module, 'corrections'),
                            'permission' => Permission::make(Res::ATTENDANCES, Actions::CORRECT),
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Daily',
                            'href'       => UrlPath::make($module, 'reports/daily'),
                            'permission' => Permission::make(Res::REPORTS, Actions::DAILY),
                        ],
                        [
                            'title'      => 'Monthly',
                            'href'       => UrlPath::make($module, 'reports/monthly'),
                            'permission' => Permission::make(Res::REPORTS, Actions::MONTHLY),
                        ],
                        [
                            'title'      => 'Entity-wise',
                            'href'       => UrlPath::make($module, 'reports/entity'),
                            'permission' => Permission::make(Res::REPORTS, Actions::ENTITY),
                        ],
                        [
                            'title'      => 'Analysis',
                            'href'       => UrlPath::make($module, 'reports/analysis'),
                            'permission' => Permission::make(Res::REPORTS, Actions::ANALYSIS),
                        ],
                    ],
                ],

                [
                    'title' => 'Devices & Modes',
                    'items' => [
                        [
                            'title'      => 'QR Attendance',
                            'href'       => UrlPath::make($module, 'modes/qr'),
                            'permission' => Permission::make(Res::MODES, Actions::QR),
                        ],
                        [
                            'title'      => 'Biometric',
                            'href'       => UrlPath::make($module, 'modes/biometric'),
                            'permission' => Permission::make(Res::MODES, Actions::BIOMETRIC),
                        ],
                        [
                            'title'      => 'RFID / Card',
                            'href'       => UrlPath::make($module, 'modes/rfid'),
                            'permission' => Permission::make(Res::MODES, Actions::RFID),
                        ],
                        [
                            'title'      => 'Self Attendance',
                            'href'       => UrlPath::make($module, 'modes/self'),
                            'permission' => Permission::make(Res::MODES, Actions::SELF),
                        ],
                    ],
                ],

                [
                    'title' => 'Configuration',
                    'items' => [
                        [
                            'title'      => 'Session Types',
                            'href'       => UrlPath::make($module, 'config/session-types'),
                            'permission' => Permission::update(Res::SESSION_TYPES),
                        ],
                        [
                            'title'      => 'Rules',
                            'href'       => UrlPath::make($module, 'config/rules'),
                            'permission' => Permission::update(Res::RULES),
                        ],
                        [
                            'title'      => 'Statuses-Codes',
                            'href'       => UrlPath::make($module, 'config/statuses'),
                            'permission' => Permission::update(Res::STATUSES),
                        ],
                    ],
                ],

                [
                    'title' => 'Settings',
                    'items' => [
                        [
                            'title'      => 'Basic Settings',
                            'href'       => UrlPath::makeSettings($module),
                            'permission' => Permission::update(Res::SETTINGS),
                        ],
                        [
                            'title'      => 'Permissions',
                            'href'       => UrlPath::make($module, 'settings/permissions'),
                            'permission' => Permission::update(Res::SETTINGS),
                        ],
                    ],
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

        KeyName::make(Res::WEEKLY_OFFS)	=> [
			[
                'title'      => 'Delete',
                'href'       => UrlPath::makeDelete($module, '{id}'),
                'permission' => Permission::delete(Res::WEEKLY_OFFS),
                'action'     => 'delete',
                'method'     => 'DELETE',
                'variant'    => 'danger',
            ],
		],
		KeyName::make(Res::HOLIDAYS)			=> [
			[
                'title'      => 'Delete',
                'href'       => UrlPath::makeDelete($module, '{id}'),
                'permission' => Permission::delete(Res::HOLIDAYS),
                'action'     => 'delete',
                'method'     => 'DELETE',
                'variant'    => 'danger',
            ],
		],
		KeyName::make(Res::CALENDAR_DAYS) 	=> [
			[
                'title'      => 'Delete',
                'href'       => UrlPath::makeDelete($module, '{id}'),
                'permission' => Permission::delete(Res::CALENDAR_DAYS),
                'action'     => 'delete',
                'method'     => 'DELETE',
                'variant'    => 'danger',
            ],
		],
		KeyName::make(Res::SCHEDULES) 		=> [
			[
                'title'      => 'Generate Sessions',
                'href'       => '#',//UrlPath::make($module, Actions::GENERATE . '/{id}'),
                'permission' => Permission::view(Res::SCHEDULES),
				'action'     => 'custom',
				'method'     => 'POST',
				'custom'     => [
					'apiEndpoint' => 'attendance/schedules/{id}/generate-sessions',
					'successMessage' => 'Sessions generated successfully.',
					'errorMessage' => 'Failed to generate sessions.',
				],
				'variant'    => 'success',
            ],

			[
                'title'      => 'Update',
                'href'       => UrlPath::makeUpdate($module, '{id}'),
                'permission' => Permission::update(Res::SCHEDULES),
                'action'     => 'update',
            ],

            [
                'title'      => 'Delete',
                'href'       => UrlPath::makeDelete($module, '{id}'),
                'permission' => Permission::delete(Res::SCHEDULES),
                'action'     => 'delete',
                'method'     => 'DELETE',
                'variant'    => 'danger',
            ]
		],
		KeyName::make(Res::BATCHES) 			=> [
			[
                'title'      => 'Update',
                'href'       => UrlPath::makeUpdate(Res::BATCHES, '{id}'),
                'permission' => Permission::update(Res::BATCHES),
                'action'     => 'update',
            ],

			[
                'title'      => 'Add Participants',
                'href'       => UrlPath::make(Res::BATCHES, '{id}/participants'),
                'permission' => Permission::update(Res::BATCHES),
                'action'     => 'update',
            ],

			[
				'title'      => 'Delete',
				'href'       => UrlPath::makeDelete(Res::BATCHES, '{id}'),
				'permission' => Permission::delete(Res::BATCHES),
				'action'     => 'delete',
				'method'     => 'DELETE',
				'variant'    => 'danger',
			]
		],
		KeyName::make(Res::SESSIONS)			=> [
			[
				'title'      => 'Mark Attendance',
				'href'       => UrlPath::make($module, 'mark?session={id}'),
				'permission' => Permission::make(Res::ATTENDANCES, Actions::MARK),
			],
			[
				'title'      => 'Update',
				'href'       => UrlPath::make($module, 'sessions/update/{id}'),
				'permission' => Permission::update(Res::SESSIONS),
				'action'     => 'update',
			],
			[
				'title'      => 'View Details',
				'href'       => UrlPath::make($module, 'sessions/{id}'),
				'permission' => Permission::view(Res::SESSIONS),
				'action'     => 'view',
			],
			[
				'title'      => 'Delete',
				'href'       => UrlPath::makeDelete($module, '{id}'),
				'permission' => Permission::delete(Res::SESSIONS),
				'action'     => 'delete',
				'method'     => 'DELETE',
				'variant'    => 'danger',
			]
		],
		KeyName::make(Actions::LIST) 			=> []

    ],

    /*
    |--------------------------------------------------------------------------
    | List Filters
    |--------------------------------------------------------------------------
    */
    'filters' => [

		KeyName::make(Res::WEEKLY_OFFS) 	=> [],
		KeyName::make(Res::HOLIDAYS) 		=> [],
		KeyName::make(Res::CALENDAR_DAYS) 	=> [],
		KeyName::make(Res::SCHEDULES) 		=> [],
		KeyName::make(Res::BATCHES) 		=> [],
		KeyName::make(Res::BATCH_PARTICIPANTS) 		=> [],
		KeyName::make(Res::SESSIONS) 		=> [],
        KeyName::make(Actions::LIST) 		=> [

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
