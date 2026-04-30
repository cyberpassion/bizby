<?php

$pg = 'note';

return [

    /* =========================
     | BULK OPERATIONS
     ========================= */
    'bulk-operations' => [
        'view:detail' => 'View Detail',
        'op:remove'   => 'Delete',
        'op:restore'  => 'Restore',
    ],

    /* =========================
     | COLUMNS
     ========================= */
    'columns' => [

    /* LIST VIEW */
    'list' => [
	    'id'                    => 'ID',
    	'name'                  => 'Name',
		'vendor_code'           => 'Vendor Code',
    	'vendor_type'           => 'Vendor Type',
    	'vendor_gstin'          => 'GSTIN',
    	'vendor_pan'            => 'PAN',
    	'vendor_person'         => 'Contact Person',
    	'vendor_person_phone'   => 'Contact Phone',
    	'state'                 => 'State',
    	'place'              => 'Place',
    	'status_label'          => 'Status',
	],

    /* DETAIL VIEW */
    'detail' => [
    	'id'                          => 'ID',
	    'vendor_code'                 => 'Vendor Code',
    	'vendor_type'                 => 'Vendor Type',
    	'vendor_parent_id'            => 'Parent Vendor',

	    /* Person */
    	'name'                        => 'Name',
	    'phone'                       => 'Phone',
    	'email'                       => 'Email',
    	'address'                     => 'Address',

    /* Business */
    'vendor_gstin'                => 'GSTIN',
    'vendor_pan'                  => 'PAN',
    'vendor_info'                 => 'Vendor Info',
    'vendor_bank_info'            => 'Bank Info',
    'vendor_terms_and_condition'  => 'Terms & Conditions',

    /* Contact Person */
    'vendor_person'               => 'Contact Person',
    'vendor_person_designation'   => 'Designation',
    'vendor_person_phone'         => 'Contact Phone',
    'vendor_person_email'         => 'Contact Email',

    /* Location */
    'state'                       => 'State',
    'place'                    => 'Place',
    'region'                      => 'Region',
    'sales'                       => 'Sales',
    'thread_parent'               => 'Thread Parent',
    'incentive_percentage'        => 'Incentive (%)',

    /* System */
    'status_label'            	  => 'Status',
    'created_at'                  => 'Created At',
    'updated_at'                  => 'Updated At',
],

    /* REPORT / EXPORT / OTHER */
    'report' => [
    'id'                      => 'ID',
    'name'                    => 'Name',
	'vendor_code'             => 'Vendor Code',
    'vendor_type'             => 'Vendor Type',
    'vendor_gstin'            => 'GSTIN',
    'vendor_pan'              => 'PAN',
    'state'                   => 'State',
    'place'                => 'Place',
    'vendor_person'           => 'Contact Person',
    'vendor_person_phone'     => 'Contact Phone',
    'incentive_percentage'    => 'Incentive (%)',
    'status_label'            => 'Status',
    'created_at'              => 'Created At',
],

    /* SAMPLE EXPORT */
    'sample_export' => [
        'vendor_code',
        'vendor_type',
        'name',
        'phone',
        'email',
        'vendor_gstin',
        'vendor_pan',
        'state',
        'place',
        'vendor_person',
        'vendor_person_phone',
        'incentive_percentage',
        'status',
    ],

    /* USER SELECTABLE */
    'selectable' => [
        'vendor_code',
        'vendor_type',
        'name',
        'vendor_gstin',
        'state',
        'place',
        'status',
    ],
],

    /* =========================
     | STATUSES
     ========================= */
    'statuses' => [
        '1'  => 'Active',
        '2'  => 'Deleted',
		'21' => 'Inactive',
    ],

    /* =========================
     | CRONS
     ========================= */
    'crons' => [
        'note-timeboundnotification' => 'Note Reminders',
    ],

    /* =========================
     | DOCUMENTS (optional future)
     ========================= */
    'documents' => [
        'detail' => 'Note Detail',
    ],

    /* =========================
     | UPLOADS (optional)
     ========================= */
    'uploads' => [
        'document' => 'Document',
    ],

    /* =========================
     | FILTERS (converted)
     ========================= */
    'filters' => [

        'list' => [
            [
                'type'        => 'date:Y-m-d',
                'name'        => 'date:Y-m-d',
                'placeholder' => 'Date',
                'dataKey'     => 'note.note_date',
            ],
            [
                'type'        => 'select',
                'name'        => 'session',
                'placeholder' => 'Session',
                'dataKey'     => 'session.session',
            ],
            [
                'type'        => 'select',
                'name'        => 'added_by_type',
                'placeholder' => 'Added By',
                'dataKey'     => 'added_by_type.list',
            ],
            [
                'type'        => 'select',
                'name'        => 'note_type',
                'placeholder' => 'Note Type',
                'dataKey'     => 'student_note_type',
            ],
            [
                'type'        => 'select',
                'name'        => 'status',
                'placeholder' => 'Status',
                'dataKey'     => 'note.statuses',
            ],
        ],

    ],

    /* =========================
     | COMMUNICATION TEMPLATES
     ========================= */
    'communication-templates' => [
        'note_entry_new_sms'    => 'New Note Entry SMS',
        'note_entry_new_email'  => 'New Note Entry Email',
        'note_comment_new_sms'  => 'New Note Comment SMS',
    ],

    /* =========================
     | COLUMN LABELS
     ========================= */
    'column-mapping' => [
        'note_id'         => 'ID',
        'added_by'        => 'Name',
        'note_type'       => 'Type',
        'added_for'       => 'For',
        'response_status' => 'R/Status',
    ],

    /* =========================
     | MODULE TABLES
     ========================= */
    'tables' => [
        'terms',
        'cyp_activity',
        'cyp_notification',
        'cyp_message',
        'cyp_note',
    ],

    /* =========================
     | VALIDATION META
     ========================= */
    'validation' => [
        'mandatory' => ['information'],
        'date'      => ['date', 'note_end_date'],
    ],

];