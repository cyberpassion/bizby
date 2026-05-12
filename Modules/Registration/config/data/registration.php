<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\KeyName;
use Modules\Shared\Support\Permission;
use Modules\Registration\Support\Res;
use Modules\Registration\Support\Actions;

$pg = 'registration';

return [

	// Bulk Operations
    "bulk-operations" => [
        "registration:detail" => "Move to",
        "view:detail"         => "View Detail",
        "op:remove"           => "Delete",
        "op:restore"          => "Restore"
    ],

	// Default Columns
    "columns" => [
		KeyName::make(Res::TYPES) => [
			Actions::LIST => [
				'id'				  => 'ID',
			    'date'                => 'Date',
    			'name'                => 'Name',
				'created_at'		  => 'Created',
				'is_active'			  => 'Active',
    			'status_label'        => 'Status',
			],
			Actions::DETAIL => [
				'id'				  => 'ID',
    			'date'                => 'Date',
	    		'name'                => 'Name',
				'created_at'		  => 'Created',
				'is_active'			  => 'Active',
    			'status_label'        => 'Status',
			],
			Actions::REPORT => [
				'id'				  => 'ID',
    			'date'                => 'Date',
		    	'name'                => 'Name',
				'created_at'		  => 'Created',
				'is_active'			  => 'Active',
    			'status_label'        => 'Status',
			],
			Actions::SAMPLE_EXPORT => [
				'id'				  => 'ID',
    			'date'                => 'Date',
		    	'name'                => 'Name',
				'created_at'		  => 'Created',
				'is_active'			  => 'Active',
    			'status_label'        => 'Status',
			],
	        Actions::SELECTABLE => [
				'id'				  => 'ID',
    			'date'                => 'Date',
		    	'name'                => 'Name',
				'created_at'		  => 'Created',
				'is_active'			  => 'Active',
    			'status_label'        => 'Status',
			]
		],
		KeyName::make(Res::CYCLES) => [
			Actions::LIST => [
				'id'		   => 'ID',
			    'name'         => 'Name',
				'start_date'   => 'Start Date',
				'end_date'		 => 'End Date',
		    	'status_label' => 'Status',
			],

			Actions::DETAIL => [
				'id'		   => 'ID',
    		    'name'         => 'Name',
        		'start_date'   => 'Start Date',
		        'end_date'     => 'End Date',
    		    'status_label' => 'Status',
    		],

		    Actions::REPORT => [
				'id'		   => 'ID',
        		'name'         => 'Name',
	        	'start_date'   => 'Start Date',
    	    	'end_date'     => 'End Date',
        		'status_label' => 'Status',
		    ],

		    Actions::SAMPLE_EXPORT => [
    		    'name',
        		'start_date',
	        	'end_date',
    	    	'status_label'
	    	],

		    Actions::SELECTABLE => [
    		    'name',
        		'start_date',
	        	'end_date',
    	    	'status_label'
	    	],
		],
		KeyName::make(Res::REGISTRATIONS) => [
		    Actions::LIST => [
				'id'				  => 'ID',
        		'user_name'           => 'User',
				'user_email'		  => 'Email',
		        'cycle_name'		  => 'Cycle',
		        'registration_status' => 'Status',
        		'submitted_at'        => 'Submitted At',
		    ],

		    Actions::DETAIL => [
				'id'				  => 'ID',
		        'user_name'           => 'User',
				'user_email'		  => 'Email',
        		'cycle_name'		  => 'Cycle',
        		'registration_status' => 'Status',
		        'submitted_at'        => 'Submitted At',
    		],

		    Actions::REPORT => [
				'id'				  => 'ID',
		        'user_name'           => 'User',
				'user_email'		  => 'Email',
        		'cycle_name'		  => 'Cycle',
        		'registration_status' => 'Status',
		        'submitted_at'        => 'Submitted At',
    		],

		    Actions::SAMPLE_EXPORT => [
		        'user_name',
        		'cycle_name',
		        'current_step',
        		'registration_status',
		        'submitted_at'
    		],

		    Actions::SELECTABLE => [
		        'user_name',
		        'cycle_name',
        		'current_step',
		        'registration_status',
        		'submitted_at'
		    ]
		],
    ],

    // Crons
    "crons" => [
        'registration-notification' => 'Registration Notification'
    ],

    // Documents
    "documents" => [
        'registration-slip' => 'Registration Slip',
        'registration-form' => 'Registration Form'
    ],

	// Status
    'statuses' => [
        '1'  => 'Active',
        '2'  => 'Deleted'
    ],

	// Uploads
    'uploads' => [
        'image' => 'Image',
    ],

];
