<?php
$pg = 'treatment';
$commonSettingsRoute = '/settings';

return [

'sidebar-menu' => /* =========================
 | Treatment Module
 ========================= */
[
    'title' => ucfirst($pg),
    'href'  => "/{$pg}",
    'permission' => "{$pg}.access",
    'items' => [

        /* =========================
         | Treatment Management
         ========================= */
        [
            'title' => 'Treatment',
            'items' => [
                [
                    'title'      => 'Add New',
                    'href'       => "/module/{$pg}/new",
                    'permission' => "{$pg}.create",
                ],
                [
                    'title'      => 'View List',
                    'href'       => "/module/{$pg}/list",
                    'permission' => "{$pg}.view",
                ],
                [
                    'title'      => 'View Report',
                    'href'       => "/module/{$pg}/report",
                    'permission' => "{$pg}.report",
                ],
            ],
        ],

        /* =========================
         | Settings
         ========================= */
        [
            'title' => 'Settings',
            'href'  => "/module/{$pg}/settings",
            'permission' => "{$pg}.settings",
        ],

        /* =========================
         | Plugins
         ========================= */
        [
            'title' => 'Plugins',
            'items' => [
                [
                    'title'      => 'View Calendar',
                    'href'       => "/plugin/calendar?module={$pg}",
                    'permission' => "{$pg}.plugin.calendar",
                ],
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
    'treatment.default-columns' => [
                        'entry'				=>	['treatment_id', 'treatment_date', 'treatment_time', 'person', 'observedby', 'observation', 'treatment_given', 'treatment_remark','tags', 'status'],
                        'list'				=>	['treatment_id', 'treatment_date', 'treatment_time', 'person', 'observedby', 'observation', 'treatment_given', 'treatment_remark','tags', 'status'],
                        'detail'			=>	['treatment_id', 'treatment_date', 'treatment_time', 'person', 'observedby', 'observation', 'treatment_given', 'treatment_remark','tags', 'status'],
                        'report'			=>	['treatment_id', 'treatment_date', 'treatment_time', 'person', 'observedby', 'observation', 'treatment_given', 'treatment_remark','tags', 'status'],
                        'sample_export'		=>	['sno', 'treatment_date', 'treatment_time', 'observedby', 'observation', 'treatment_given', 'treatment_remark'],
                        'selected_columns'	=>	['treatment_date', 'treatment_time', 'observedby', 'observation', 'treatment_given', 'treatment_remark']
    ],
    'treatment.statuses' => [
                        '1'		=>	'Active',
                        '2'		=>	'Deleted',
                        '21'	=>	'Departed'
    ],
    'treatment.list-columns' => [
                        'id',
                        'patient_id',
                        'treatment_date',
                        'treatment_time',
                        'treatment_given',
                        'patient_status',
    ],

    'treatment.list-filters' => [
                        'patient_id',
                        'treatment_date',
                        'patient_status',
                        'user_id',
                        'treatment_recipient_type',
    ],

    'treatment.report-columns' => [
                        'id',
                        'patient_id',
                        'treatment_sno',
                        'treatment_date',
                        'treatment_time',
                        'observedby',
                        'observation',
                        'treatment_given',
                        'treatment_fee',
                        'patient_status',
                        'treatment_recipient',
                        'created_at',
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
    'treatment-type' => ["treatment","test","room-allotment"],

    'treatment-report-type' => [
                        "stock"			=>	"All Treatment List",
                        "treatment"		=>	"Patient Treatment"
    ],
    'treatment-unit' => ["unit"	=>	"Sample"]

];
