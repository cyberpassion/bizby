<?php
$pg = 'employee';
$commonSettingsRoute = '/settings';

return [
	'menuItem-employee' => [
		'admin'	=>	[
			'parent'		=>	[
				$pg	=>	'#',
			],
			'child'		=>	[
				$pg	=>	[
					['Add New'		=> "/{$pg}/create"],
	                ['View List'	=> "/{$pg}/list"],
    	            ['Report'		=> "/{$pg}/report"],
        	        ['Settings'		=> "/{$pg}/settings"],
				],
			],
		],
	],
    'sidebar-menu' => [
        [
            'title' => ucfirst($pg),
            'href' => "/{$pg}",
            'items' => [
                ['title' => 'Home', 'href' => "/module/{$pg}/home"],
				['title' => 'Add New', 'href' => "/module/{$pg}/new"],
                ['title' => 'View List', 'href' => "/module/{$pg}/list"],
                ['title' => 'Report', 'href' => "/module/{$pg}/report"],
                ['title' => 'Settings', 'href' => "/module/{$pg}/settings"],
            ],
        ],
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
		                "cyp_term",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "cyp_upload",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_employee"
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
	"mandatoryFields-employee_entry_update" => ['employee_name', 'phone_number'],

	"dateFields-employee_entry_update" => ['dob', 'date', 'date_of_joining', 'date_of_relieving'],

	"additionalFields-employee_entry_update" => ['employee_additional_field'],

	"jsonFields-employee_entry_update" => ['qualifications', 'job_responsibility', 'teaching_subjects', 'teaching_classes', 'announcement_permission', 'attendance_permission'],

	"listFilters-employee_list" => [
                        "admin"	=>	[
                             'employee_type_filter one'	=> "Employee Type/employee_type/employee_type-json",
                            'sort status' 				=> "Status/status/status-json"
                        ],
                        "portal" => [
                             'employee_type_filter one' 	=> "Employee Type/employee_type/employee_type-json",
                              'sort status' 				=> "Status/status/status-json"
                        ]
	],
	"listFilters-employee_employee-report_new" => [
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
	"formPrefills- employee_entry_new" => [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
	],
	"search_column-json" => ["employee_name", "phone_number"],

	"employee_status-json" => [
		                '1'		=>	'Active',
                        '11'	=>	'Draft',
                        '2'		=>	'Deleted',
                        '21'	=>	'Departed'
	],
	"employee_document-json" => [
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
	"employee_bulk_operation-list" => [
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
	"sort_employee_results_by-list" => [
                        "employee_name"		=>	"EMPLOYEE NAME",
                        "father_name"		=>	"FATHER NAME",
                        "employee_id"		=>	"EMPLOYEE ID",
                        "dob"				=>	"DATE OF BIRTH"
	],
	"employee_note_type-json" => [
                        "performance"			=>	"Performance",
                        "other"					=>	"Other"
	],

	"employee_leave_type-list" => ["paid" => "Paid", "not-paid" => "Not-Paid"],

	"employee_leave_duration" => ["0.5" => "Full Day", "1" => "Half Day"],

	"advancedInfo_connectors-json" => ["canbe_assignee"	=>	true]

];
