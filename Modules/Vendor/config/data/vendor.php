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
            'note_id',
            'added_by',
            'subject',
            'note_type',
            'added_for',
            'response_status',
            'tags',
            'status',
        ],

        /* REPORT VIEW */
        'report' => [
            'id',
            'subject',
            'note_type',
            'context',
            'added_for',
            'added_by',
            'note_end_date',
            'note_end_time',
            'created_at',
        ],

        /* DETAIL VIEW */
        'detail' => [
            'note_id',
            'added_by',
            'subject',
            'note_type',
            'added_for',
            'response_status',
            'tags',
            'status',
        ],

        /* SAMPLE EXPORT */
        'sample_export' => [
            'subject',
            'note_type',
            'added_for',
            'added_by',
            'note_end_date',
            'note_end_time',
            'status',
        ],

        /* USER SELECTABLE */
        'selectable' => [
            'subject',
            'note_type',
            'added_for',
            'added_by',
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