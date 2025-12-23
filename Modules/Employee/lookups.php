<?php
$pg = 'employee';
$commonSettingsRoute = '/settings';

return [

	'sidebar-menu' => [
    	[
	        'title' => ucfirst($pg),
    	    'href'  => "/{$pg}",
        	'items' => [
            	['title' => 'Home',      'href' => "/module/{$pg}/home"],
	            ['title' => 'Add New',   'href' => "/module/{$pg}/new"],
    	        ['title' => 'View List', 'href' => "/module/{$pg}/list"],
        	    ['title' => 'Report',    'href' => "/module/{$pg}/report"],
            	['title' => 'Settings',  'href' => "/module/{$pg}/settings"],
	            [
    	            'title' => 'Settings',
        	        'items' => [
            	        ['title' => 'Salary Settings', 'href' => "/module/{$pg}/settings/salary"],
                	]
	            ],
    	        [
        	        'title' => 'Report',
            	    'items' => [
                	    ['title' => 'Salary Report', 'href' => "/module/{$pg}/report/salary"],
                	]
	            ],
    	        ['title' => 'Bulk Operation', 'href' => "/module/{$pg}/bulk"],
        	    [
            	    'title' => 'Plugin',
                	'items' => [
                    	['title' => 'View Calendar', 'href' => "/module/{$pg}/plugin/calendar"],
                	]
            	],
        	],
    	],
	],

	'employee-status' => [
		'1'		=>	'Active',
        '11'	=>	'Draft',
        '2'		=>	'Deleted',
        '21'	=>	'Departed'
	],

	"communicationTemplate-employee" => [
                        "employee_entry_new_sms"		=>	"New Employee Entry SMS",
                        "employee_entry_new_whatsapp"	=>	"New Employee Entry Whatsapp",
                        "employee_entry_new_email"		=>	"New Employee Entry Email",
                        "employee_salary_new_sms"		=>	"New Employee Salary SMS",
                        "employee_salary_new_whatsapp"	=>	"New Employee Salary Whatsapp",
                        "employee_salary_new_email"		=>	"New Employee Salary Email",
                        "employee_birthday_new_sms"			=>	"Employee Birthday SMS",
                        "employee_birthday_new_whatsapp"	=>	"Employee Birthday Whatsapp",
                        "employee_birthday_new_email"		=>	"Employee Birthday Email",
    ],
	"columnNameMapping-employee" => [
		                'employee_id'		=>	'ID',
                        'employee_name'		=>	'Name',
                        'employee_type'		=>	'Type',
                        'designation'		=>	'Designation',
                        'educational_qualification'	=>	'Edu. Qual.',
                        'professional_qualification' =>	'Prof. Qual.',
                        'teaching_exam_qualified'	=>	'Exam Qual.',
                        'date_of_joining'			=>	'Joining Date',
                        'secondary_passing_roll_no'	=>	'School Passing Roll',
                        'secondary_passing_year'	=>	'School Passing Year',
                        'teaching_subjects'	=>	'Subjects',
	],
	"mandatoryOptionsBeforeUsing-employee" => [
		                'missing_option'	=>	[
                            'Employee Types'			=>	'employee_type-json'
                        ]
	],
	"moduleTable-employee" => [
		                "terms",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "uploads",
                        "cyp_notification",
                        "cyp_message",
                        "employees"
	],
	"defaultColumns-employee" => [
		                'entry'				=>	['employee_id', 'employee_name', 'employee_type', 'designation', 'permanent_address', 'dob','tags', 'status'],
                        'list'				=>	['employee_id', 'employee_name', 'employee_type', 'designation', 'permanent_address', 'dob','tags', 'status'],
                        'detail'			=>	['employee_id', 'employee_name', 'employee_type', 'designation', 'permanent_address', 'dob','tags', 'status'],
                        'report'			=>	['employee_id', 'employee_name', 'employee_type', 'designation', 'permanent_address', 'dob','tags', 'status'],
                        'sample_export'		=>	['sno', 'employee_name', 'employee_type', 'designation', 'permanent_address', 'dob', 'phone_number', 'email_id'],
                        'selected_columns'	=>	['employee_name', 'employee_type', 'designation', 'permanent_address', 'dob', 'phone_number', 'email_id']
	],

	"interactiveEntity-employee" =>['employee'],
    
	"cronList-employee" => [
		                'employee-birthday' => 'Employee Birthday Message'
	],
	"mandatoryFields-employee-entry-update" => ['employee_name', 'phone_number'],

	"dateFields-employee-entry-update" => ['dob', 'date', 'date_of_joining', 'date_of_relieving'],

	"additionalFields-employee-entry-update" => ['employee_additional_field'],

	"jsonFields-employee-entry-update" => ['qualifications', 'job_responsibility', 'teaching_subjects', 'teaching_classes', 'announcement_permission', 'attendance_permission'],

	"listFilters-employee-list" => [
                        "admin"	=>	[
                             'employee_type_filter one'	=> "Employee Type/employee_type/employee_type-json",
                            'sort status' 				=> "Status/status/status-json"
                        ],
                        "portal" => [
                             'employee_type_filter one' 	=> "Employee Type/employee_type/employee_type-json",
                              'sort status' 				=> "Status/status/status-json"
                        ]
	],
	"listFilters-employee-employee-report-new" => [
                        "admin"	=>	[
                            'report_type_filter'	=> "Report Type/report_type/employee_type-json"
                        ],
                        "portal" => [
                            'report_type_filter'	=> "Report Type/report_type/employee_type-json"
                        ]
	],
	"permissionAdmin-employee" => [
                        'restricted'	=>	[
                            '2'	=>	[
                                ['pg' => $pg, 'sub_pg'	=>	'settings']
                            ],
                            '3'	=>	[
                                ['pg' => $pg, 'sub_pg'	=>	'fee-entry']
                            ]
                        ]
    ],
	"permissionAllowedAdmin-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'home'],
                        ['pg' => $pg, 'sub_pg'	=>	'entry'],
                        ['pg' => $pg, 'sub_pg'	=>	'list'],
                        ['pg' => $pg, 'sub_pg'	=>	'report'],
                        ['pg' => $pg, 'sub_pg'	=>	'document'],
                        ['pg' => $pg, 'sub_pg'	=>	'profile'],
                        ['pg' => $pg, 'sub_pg'	=>	'salary-list']
	],
	"permissionPortal-employee" => [
                        'restricted'	=>	[],
                        'allowed'		=>	[
                            ['pg' => $pg, 'sub_pg'	=>	'home'],
                            ['pg' => $pg, 'sub_pg'	=>	'profile'],
                            ['pg' => $pg, 'sub_pg'	=>	'salary-history'],
                            ['pg' => $pg, 'sub_pg'	=>	'document'],
                            ['pg' => $pg, 'sub_pg'	=>	'history'],
                            ['pg' => $pg, 'sub_pg'	=>	'report'],
                            ['pg' => $pg, 'sub_pg'	=>	"{$pg}-report"], // logic is different in portal_page_access_barricade
                        ]
	],
	"permissionAllowedPortal-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'home'],
                        ['pg' => $pg, 'sub_pg'	=>	'profile'],
                        ['pg' => $pg, 'sub_pg'	=>	'salary-history'],
                        ['pg' => $pg, 'sub_pg'	=>	'document'],
                        ['pg' => $pg, 'sub_pg'	=>	'history'],
                        ['pg' => $pg, 'sub_pg'	=>	'report'],
                        ['pg' => $pg, 'sub_pg'	=>	"{$pg}-report"], // logic is different in portal_page_access_barricade
	],
	"permissionAllowedFiltersPortal-employee" => [
                        "profile"	=>	[[ "employee_id"	=>	'{$login_id}' ]],
                        "list"		=>	[[ "employee_id"	=>	'{$login_id}' ]],
                        "report"	=>	[[ "employee_id"	=>	'{$login_id}' ]]
	],
	"formPrefills-employee-entry-new" => [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
	],
	"search-column" => ["employee_name", "phone_number"],

	"employee-document" => [
		                 'offer-letter'					=> 'Offer Letter',
                        'employer-bond'					=> 'Employer Bond',
                        'appointment-letter'			=> 'Appointment Letter',
                        'salary-increment-letter'		=> 'Salary Increment Letter',
                        'promotion-letter'				=> 'Promotion Letter',
                        'relieving-letter'				=> 'Relieving Letter',
                        'experience-certificate'		=> 'Experience Certificate',
                        'internship-certificate'		=> 'Internship Certificate',
                        'employee-id-card'				=> 'ID Card'
	],
	"employee-bulk-operation-list" => [
                        "document:offer-letter"				=>	"Print Offer Letter",
                        "document:employer-bond"			=>	"Print Employer Bond",
                        "document:appointment-letter"		=>	"Print Appointment Letter",
                        "document:salary-increment-letter"	=>	"Print Salary Increment Letter",
                        "document:relieving-letter"			=>	"Print Relieving Letter",
                        "document:experience-certificate"	=>	"Print Experience Certificate",
                        "document:internship-certificate"	=>	"Print Internship Certificate",
                        "document:employee-id-card"			=>	"Print ID Card",
                        "send:email"					=>	"Send Email",
                        "send:sms"						=>	"Send SMS",
                        "op:remove"						=>	"Delete",
                        "op:restore"					=>	"Restore"
    ],
	"sort-employee-results-by-list" => [
                        "employee_name"		=>	"EMPLOYEE NAME",
                        "father_name"		=>	"FATHER NAME",
                        "employee_id"		=>	"EMPLOYEE ID",
                        "dob"				=>	"DATE OF BIRTH"
	],
	"employee-note-type" => [
                        "performance"			=>	"Performance",
                        "other"					=>	"Other"
	],

	"employee-leave-type-list" => ["paid" => "Paid", "not-paid" => "Not-Paid"],

	"employee-leave_duration" => ["0.5" => "Full Day", "1" => "Half Day"],

	"advancedInfo-connectors" => ["canbe_assignee"	=>	true]

];
