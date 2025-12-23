<?php
$pg = 'treatment';
$commonSettingsRoute = '/settings';

return [

'sidebar-menu' => [
    [
        'title' => ucfirst($pg),
        'href'  => "/{$pg}",
        'items' => [
            ['title' => 'Add New',     'href' => "/module/{$pg}/new"],
            ['title' => 'View List',   'href' => "/module/{$pg}/list"],
            ['title' => 'View Report', 'href' => "/module/{$pg}/report"],
            ['title' => 'Settings',    'href' => "/module/{$pg}/settings"],
            [
                'title' => 'Plugin',
                'items' => [
                    ['title' => 'View Calendar', 'href' => "/plugin/calendar?module={$pg}"],
                ]
            ],
        ],
    ],
],

    'treatment.list-filters' => [
                        "admin"	=>	[
                            'treatment_date_filter' => "Date/treatment_date/treatment_entry_date-json",
                            'treatment_nextdate_filter' => "Next Date/next_date/treatment_next_entry_date-json",
                            'treatment_with_filter one' => "Doctor/treatment_with/employee_id-json",
                            'treatment_through_filter one' => "Mode/treatment_through/treatment_through_mode-json",
                            'treatment_status_filter' => "Status/status/treatment_status-json"
                        ],
                        "portal" => [
                            'treatment_date_filter' => "Date/treatment_date/treatment_entry_date-json",
                            'treatment_nextdate_filter' => "Next Date/next_date/treatment_next_entry_date-json",
                            'treatment_with_filter one' => "Doctor/treatment_with/employee_id-json",
                            'treatment_through_filter one' => "Mode/treatment_through/treatment_through_mode-json",
                            'treatment_status_filter' => "Status/status/treatment_status-json"
                        ]
    ],
    'treatment.bulk-operations' => [
                        "document:treatment_detail"		=>	"Print Treatment Details",
                        "send:sms"						=>	"Send Treatment SMS",
                        "send:email"					=>	"Send Treatment Email",
                        "op:remove"						=>	"Delete Treatment Entry",
                        "op:restore"					=>	"Restore Treatment Entry"
    ],



    'communicationTemplate-treatment' => [
                        "treatment_entry_new_sms"		=>	"New Treatment Entry SMS",
                        "treatment_entry_new_whatsapp"	=>	"New Treatment Entry Whatsapp",
                        "treatment_entry_new_email"		=>	"New Treatment Entry Email",
    ],
    'columnNameMapping-treatment' => [
                        'treatment_id'			=>	'ID',
                        'treatment_group_id'	=>	'GID',
                        'patient_name'			=>	'Name',
                        'treatment_with'		=>	'Doctor',
                        'treatment_date'		=>	'Date',
                        'permanent_address'		=>	'Address',
                        'treatment_fee'			=>	'Fee',
                        'day_token_id'			=>	'Token No',
                        'treatment_time'		=>	'Time',
                        'treatment_through'		=>	'Mode',
                        'next_date'				=>	'Next Visit',
                        'age'					=>	'Age',
                        'treatment_given'		=>	'Treatment',
                        'treatment_remark'		=>	'Remark'
    ],
    'moduleTable-treatment' => [
                        "cyp_term",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "cyp_upload",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_patient",
                        "cyp_treatment"
    ],
    'defaultColumns-treatment' => [
                        'entry'				=>	['treatment_id', 'treatment_date', 'treatment_time', 'person', 'observedby', 'observation', 'treatment_given', 'treatment_remark','tags', 'status'],
                        'list'				=>	['treatment_id', 'treatment_date', 'treatment_time', 'person', 'observedby', 'observation', 'treatment_given', 'treatment_remark','tags', 'status'],
                        'detail'			=>	['treatment_id', 'treatment_date', 'treatment_time', 'person', 'observedby', 'observation', 'treatment_given', 'treatment_remark','tags', 'status'],
                        'report'			=>	['treatment_id', 'treatment_date', 'treatment_time', 'person', 'observedby', 'observation', 'treatment_given', 'treatment_remark','tags', 'status'],
                        'sample_export'		=>	['sno', 'treatment_date', 'treatment_time', 'observedby', 'observation', 'treatment_given', 'treatment_remark'],
                        'selected_columns'	=>	['treatment_date', 'treatment_time', 'observedby', 'observation', 'treatment_given', 'treatment_remark']
    ],
    'mandatoryFields-treatment-entry-update' => [],

    'dateFields-treatment-entry-update' => ['treatment_date'],

    'additionalFields-treatment-entry-update' => [],

    'formPrefills-treatment-entry-new' => [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
    ],
    'treatment-status' => [
                        '1'		=>	'Active',
                        '2'		=>	'Deleted',
                        '21'	=>	'Departed'
    ],
    'treatment-type' => ["treatment","test","room-allotment"],

    'treatment-report-type' => [
                        "stock"			=>	"All Treatment List",
                        "treatment"		=>	"Patient Treatment"
    ],
    'treatment-unit' => ["unit"	=>	"Sample"]

];
