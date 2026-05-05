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
			'list' => [
				'id'				  => 'ID',
			    'date'                => 'Date',
    			'name'                => 'Name',
				'created_at'		  => 'Created',
				'is_active'			  => 'Active',
    			'status_label'        => 'Status',
			],
			'detail' => [
				'id'				  => 'ID',
    			'date'                => 'Date',
	    		'name'                => 'Name',
				'created_at'		  => 'Created',
				'is_active'			  => 'Active',
    			'status_label'        => 'Status',
			],
			'report' => [
				'id'				  => 'ID',
    			'date'                => 'Date',
		    	'name'                => 'Name',
				'created_at'		  => 'Created',
				'is_active'			  => 'Active',
    			'status_label'        => 'Status',
			],
			'sample_export' => [
				'id'				  => 'ID',
    			'date'                => 'Date',
		    	'name'                => 'Name',
				'created_at'		  => 'Created',
				'is_active'			  => 'Active',
    			'status_label'        => 'Status',
			],
	        'selected_columns' => [
				'id'				  => 'ID',
    			'date'                => 'Date',
		    	'name'                => 'Name',
				'created_at'		  => 'Created',
				'is_active'			  => 'Active',
    			'status_label'        => 'Status',
			]
		],
		KeyName::make(Res::CYCLES) => [
			'list' => [
				'id'		   => 'ID',
			    'name'         => 'Name',
				'start_date'   => 'Start Date',
				'end_date'		 => 'End Date',
		    	'status_label' => 'Status',
			],

			'detail' => [
				'id'		   => 'ID',
    		    'name'         => 'Name',
        		'start_date'   => 'Start Date',
		        'end_date'     => 'End Date',
    		    'status_label' => 'Status',
    		],

		    'report' => [
				'id'		   => 'ID',
        		'name'         => 'Name',
	        	'start_date'   => 'Start Date',
    	    	'end_date'     => 'End Date',
        		'status_label' => 'Status',
		    ],

		    'sample_export' => [
    		    'name',
        		'start_date',
	        	'end_date',
    	    	'status_label'
	    	],

		    'selected_columns' => [
    		    'name',
        		'start_date',
	        	'end_date',
    	    	'status_label'
	    	],
		],
		KeyName::make(Res::REGISTRATIONS) => [
		    'list' => [
        		'user_id'             => 'User',
		        'registration_cycle_id'=> 'Cycle',
        		'current_step'        => 'Current Step',
		        'registration_status' => 'Status',
        		'submitted_at'        => 'Submitted At',
		    ],

		    'detail' => [
		        'user_id'             => 'User',
        		'registration_cycle_id'=> 'Cycle',
		        'current_step'        => 'Current Step',
        		'registration_status' => 'Status',
		        'submitted_at'        => 'Submitted At',
    		],

		    'report' => [
		        'user_id'             => 'User',
        		'registration_cycle_id'=> 'Cycle',
		        'current_step'        => 'Current Step',
        		'registration_status' => 'Status',
		        'submitted_at'        => 'Submitted At',
    		],

		    'sample_export' => [
		        'user_id',
        		'registration_cycle_id',
		        'current_step',
        		'registration_status',
		        'submitted_at'
    		],

		    'selected_columns' => [
		        'user_id',
		        'registration_cycle_id',
        		'current_step',
		        'registration_status',
        		'submitted_at'
		    ],
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
