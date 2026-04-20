<?php
$pg = 'vendor';

return [

    /* =========================
     | BULK OPERATIONS
     ========================= */
    'bulk-operations' => [
        'document:vendor-slip' => 'Print Vendor Slip',
        'send:sms'             => 'Send SMS',
        'send:email'           => 'Send Email',
        'op:remove'            => 'Delete Vendor',
        'op:restore'           => 'Restore Vendor',
    ],

    /* =========================
     | DEFAULT COLUMNS
     ========================= */
    'columns' => [

        /* LIST VIEW */
        'list' => [
            'id',
            'vendor_code',
            'name',
            'vendor_type',
            'phone',
            'state',
            'status',
        ],

        /* REPORT VIEW */
        'report' => [
            'id',
            'vendor_code',
            'name',
            'vendor_type',
            'vendor_gstin',
            'vendor_pan',
            'phone',
            'email',
            'vendor_person',
            'vendor_person_phone',
            'state',
            'district',
            'incentive_percentage',
            'status',
        ],

        /* DETAIL VIEW */
        'detail' => [
            'id',
            'vendor_code',
            'vendor_type',

            // person
            'name',
            'phone',
            'email',

            'vendor_gstin',
            'vendor_pan',

            'vendor_info',
            'vendor_bank_info',
            'vendor_terms_and_condition',

            'state',
            'district',

            'vendor_person',
            'vendor_person_designation',
            'vendor_person_phone',
            'vendor_person_email',

            'incentive_percentage',
            'thread_parent',
            'status',
        ],

        /* SAMPLE EXPORT */
        'sample_export' => [
            'name',
            'phone',
            'email',
            'vendor_type',
            'vendor_gstin',
            'vendor_pan',
            'vendor_person',
            'vendor_person_phone',
            'state',
            'district',
            'status',
        ],

        /* USER SELECTABLE */
        'selectable' => [
            'name',
            'phone',
            'vendor_type',
            'vendor_person',
            'vendor_person_phone',
            'state',
            'status',
        ],
    ],

    /* =========================
     | DOCUMENTS
     ========================= */
    'documents' => [
        'vendor-slip'    => 'Vendor Slip',
        'agreement'      => 'Agreement',
        'certificate'    => 'Certificate',
        'vendor-id-card' => 'ID Card',
    ],

    /* =========================
     | STATUSES
     ========================= */
    'statuses' => [
        '1'  => 'Active',
        '11' => 'Awaiting Approval',
        '2'  => 'Inactive',
        '6'  => 'Deleted',
    ],

    /* =========================
     | UPLOADS
     ========================= */
    'uploads' => [
        'image' => 'Image',
        'document' => 'Document',
    ],

    /* =========================
     | CRONS
     ========================= */
    'crons' => [
        'vendor-followup-reminder' => 'Vendor Follow-up Reminder',
    ],

    /* =========================
     | CUSTOM MODULE DATA
     ========================= */

    'vendor-level' => [
        'Silver',
        'Gold',
        'Platinum',
    ],

    'interactive-entity' => ['vendor'],
];