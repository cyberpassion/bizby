<?php

return [

    /* =====================================================
       COMMUNICATION MODULE
       Table: communications
    ====================================================== */
    'communication' => [

        /* =====================================================
           BULK MESSAGE
        ====================================================== */
        'bulk_message' => [

            /* PREVIEW DATA (as per communications table) */
            'preview' => [
                'batch_id'       => 1001,
                'request_id'     => 'REQ-BULK-20260118',
                'message'        => 'System maintenance will be performed tonight from 10 PM to 12 AM.',
                'recipient_type' => 'User',              // User | Employee | Student
                'recipient_id'   => 45,
                'sent_to'        => 'all@company.com',
                'mode'           => 'email',              // email | sms | whatsapp
                'service_name'   => 'Bulk Communication',
                'status'         => 1,                    // 0=failed | 1=sent | 2=queued
                'client_id'      => 1,
                'session'        => 'web',
            ],

            /* EMAIL */
            'email' => [
                'subject' => 'Bulk Message Notification',
                'view'    => 'shared::emails.communication.bulk-message',
            ],

            /* SMS */
            'sms' => [
                'template_id' => 'tmpl_bulk_message',
                'message'     => '{{message}}',
            ],

            /* WHATSAPP */
            'whatsapp' => [
                'template' => 'bulk_message',
                'params'   => [
                    'message',
                ],
            ],
        ],

        /* =====================================================
           NEW DIRECT MESSAGE
        ====================================================== */
        'new_message' => [

            /* PREVIEW DATA (as per communications table) */
            'preview' => [
                'batch_id'       => null,
                'request_id'     => 'REQ-DM-20260118',
                'message'        => 'Please review the attached meeting notes.',
                'recipient_type' => 'Employee',
                'recipient_id'   => 12,
                'sent_to'        => 'akanksha@company.com',
                'mode'           => 'email',
                'service_name'   => 'Direct Message',
                'status'         => 1,
                'client_id'      => 1,
                'session'        => 'admin-panel',
            ],

            /* EMAIL */
            'email' => [
                'subject' => 'New Message / Note',
                'view'    => 'shared::emails.communication.new-message',
            ],

            /* SMS */
            'sms' => [
                'template_id' => 'tmpl_new_message',
                'message'     => 'You have received a new message.',
            ],

            /* WHATSAPP */
            'whatsapp' => [
                'template' => 'new_message',
                'params'   => [
                    'message',
                ],
            ],
        ],
    ],
];
