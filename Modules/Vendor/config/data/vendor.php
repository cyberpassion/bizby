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
        'id',
        'vendor_code',
        'vendor_type',
        'name', // from commonPersonFields()
        'vendor_gstin',
        'vendor_pan',
        'vendor_person',
        'vendor_person_phone',
        'state',
        'district',
        'status',
    ],

    /* DETAIL VIEW */
    'detail' => [
        'id',
        'vendor_code',
        'vendor_type',
        'vendor_parent_id',

        // Person Fields
        'name',
        'phone',
        'email',
        'address',

        // Business Info
        'vendor_gstin',
        'vendor_pan',
        'vendor_info',
        'vendor_bank_info',
        'vendor_terms_and_condition',

        // Contact Person
        'vendor_person',
        'vendor_person_designation',
        'vendor_person_phone',
        'vendor_person_email',

        // Location & Meta
        'state',
        'district',
        'region',
        'sales',
        'thread_parent',
        'incentive_percentage',

        // System
        'status',
        'created_at',
        'updated_at',
    ],

    /* REPORT / EXPORT / OTHER */
    'other' => [
        'id',
        'vendor_code',
        'vendor_type',
        'name',
        'vendor_gstin',
        'vendor_pan',
        'state',
        'district',
        'vendor_person',
        'vendor_person_phone',
        'incentive_percentage',
        'status',
        'created_at',
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
        'district',
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
        'district',
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
                'type'        => 'date',
                'name'        => 'date',
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