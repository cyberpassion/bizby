<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\KeyName;
use Modules\Shared\Support\Permission;
use Modules\Attendance\Support\Res;
use Modules\Attendance\Support\Actions;

$pg = 'attendance';

return [
	'weekdays' => [
	    1 => 'Monday',
    	2 => 'Tuesday',
    	3 => 'Wednesday',
    	4 => 'Thursday',
    	5 => 'Friday',
    	6 => 'Saturday',
    	7 => 'Sunday',
	],

	'day-types' => [
	    'working'          => 'Working Day',
    	'holiday'          => 'Holiday',
    	'weekend'          => 'Weekend',
    	'blackout'         => 'Blackout',
    	'special_working'  => 'Special Working Day',
	],

    /*
    |----------------------------------------------------------------------
    | List (used by backend queries)
    |----------------------------------------------------------------------
    */
    'list' => [
        'filters' => [
            'session',
            'month',
            'absent_date',
            'absentee_type',
            'absent_code',
            'is_paid',
            'status',
        ],
        'columns' => [
            'absent_date',
            'absentee_id',
            'absentee_type',
            'absent_date_part',
            'absent_duration',
            'is_paid',
        ],
    ],

    // Default Columns
    'columns' => [
		KeyName::make(Res::WEEKLY_OFFS) => [
			'list'	=>	['id','weekday','context']
		],
		KeyName::make(Res::HOLIDAYS)    => [
			'list'	=>	['id','date','name','context']
		],
		KeyName::make(Res::CALENDAR_DAYS)    => [
			'list'	=>	['id','date','day_type','name']
		],
		KeyName::make(Res::SCHEDULES)    => [
			'list'	=>	['id','name','session','start_time','end_time','context','attendance_mode']
		],
		KeyName::make(Res::BATCHES)    => [
			'list'	=>	['id','name','start_date','end_date','participant_count']
		],
		KeyName::make(Res::SESSIONS)    => [
			'list'	=> [
			    'id',
			    'session_date',
    			'type',
	    		'context',
    			'reference',
			    'start_time',
			    'end_time',
			    'mode',
			    'taken_by'
			]
		],
		KeyName::make(Res::ATTENDANCES)    => [],
        'entry'  => ['attendance_id','date','absentee_name','absent_date','absent_type','tags','status'],
        'list'   => ['attendance_id','date','absentee_name','absent_date','absent_type','tags','status'],
        'detail' => ['attendance_id','date','absentee_name','absent_date','absent_type','tags','status'],
        'report' => ['attendance_id','date','absentee_name','absent_date','absent_type','tags','status'],
    ],

    /*
    |----------------------------------------------------------------------
    | Report Columns
    |----------------------------------------------------------------------
    */
    'report_columns' => [
        'id',
        'absent_date',
        'session',
        'month',
        'absentee_type',
        'absentee_id',
        'absent_date_part',
        'absent_duration',
        'absent_code',
        'absent_reason',
        'is_paid',
        'created_at',
    ],

    /*
    |----------------------------------------------------------------------
    | Lookups / Enums
    |----------------------------------------------------------------------
    */
    'paid_unpaid' => [
        'false' => 'Unpaid',
        'true'  => 'Paid',
    ],

    'report_types' => [
        'attendance-register-count-only' => 'Day Attendance (Percentage & Count)',
        'attendance-register'            => 'Day Attendance (Absentee Names Highlighted)',
        'singleday-absentee'              => 'Day Absentees Only',
        'multidays-absentees-with-count'  => 'Multidays Attendance Report',
        'attendance-sheet'                => 'Attendance Sheet',
        'portal-access-report'            => 'Portal & App Access Report',
    ],

    /*
    |----------------------------------------------------------------------
    | Validation Rules
    |----------------------------------------------------------------------
    */
    'mandatory_fields' => ['selected-ids'],
    'date_fields'      => ['date'],

    /*
    |----------------------------------------------------------------------
    | Communication Templates
    |----------------------------------------------------------------------
    */
    'communication_templates' => [
        'attendance_entry_new_sms'       => 'New Attendance Entry SMS',
        'attendance_entry_new_whatsapp' => 'New Attendance Entry Whatsapp',
        'attendance_entry_new_email'    => 'New Attendance Entry Email',
    ],

    /*
    |----------------------------------------------------------------------
    | DB Tables
    |----------------------------------------------------------------------
    */
    'tables' => [
        'terms',
        'cyp_activity',
        'cyp_advancedinfo',
        'cyp_allotment',
        'cyp_cash',
        'cyp_option',
        'uploads',
        'cyp_notification',
        'cyp_message',
        'cyp_announcement',
    ],

	/*
	|--------------------------------------------------------------------------
	| Session Types
	|--------------------------------------------------------------------------
	*/
	'session_types' => [
    	'day'     => 'Day (School)',
	    'lecture' => 'Lecture (College / Coaching)',
    	'shift'   => 'Shift (Office / Factory)',
    	'event'   => 'Event / Seminar',
	],

	/*
	|--------------------------------------------------------------------------
	| Attendance Modes
	|--------------------------------------------------------------------------
	*/
	'attendance_modes' => [
	    'manual'    => 'Manual',
    	'qr'        => 'QR Code',
	    'biometric' => 'Biometric',
    	'rfid'      => 'RFID',
    	'geofence'  => 'Geo-fence',
    	'self'      => 'Self Punch',
    	'system'    => 'System',
	],

];
