<?php

return [

    'lead' => [

        /* =================================================
           NEW LEAD CREATED
           → when a new row is inserted in leads
        ================================================= */
        'created' => [

            'source_table' => 'leads',

            'preview' => [
                'lead_id'        => 501,
                'lead_code'      => 'LEAD-2026-001',
                'name'           => 'Amit Verma',
                'contact_person'=> 'Amit Verma',
                'mobile'         => '+91-9876543210',
                'email'          => 'amit@example.com',
                'district'       => 'Noida',
                'state'          => 'Uttar Pradesh',
                'source_id'      => 2,        // Website / Campaign
                'generated_by'   => 'System', // morph (User / Employee)
            ],

            'email' => [
                'subject' => 'New Lead Received',
                'view'    => 'shared::emails.lead.new-lead',
            ],
        ],

        /* =================================================
           LEAD ASSIGNED
           → assigned_to_id / assigned_to_type changed
        ================================================= */
        'assigned' => [

            'source_table' => 'leads',

            'preview' => [
                'lead_id'        => 501,
                'name'           => 'Amit Verma',
                'mobile'         => '+91-9876543210',
                'email'          => 'amit@example.com',

                // morph relation
                'assigned_to_id'   => 101,
                'assigned_to_type' => 'Employee',
                'assigned_to_name' => 'Rahul Sharma',

                'assigned_by'      => 'Sales Manager',
            ],

            'email' => [
                'subject' => 'New Lead Assigned to You',
                'view'    => 'shared::emails.lead.lead-assigned',
            ],
        ],

        /* =================================================
           LEAD FOLLOW-UP REMINDER
           → based on next_followup_date
        ================================================= */
        'followup_reminder' => [

            'source_table' => 'leads',

            'preview' => [
                'lead_id'            => 501,
                'name'               => 'Amit Verma',
                'mobile'             => '+91-9876543210',

                'assigned_to_name'   => 'Rahul Sharma',
                'next_followup_date' => '2026-01-20',

                'remarks'            => 'Interested, call after 5 PM',
            ],

            'email' => [
                'subject' => 'Lead Follow-up Reminder',
                'view'    => 'shared::emails.lead.lead-followup-reminder',
            ],
        ],

        /* =================================================
           LEAD STATUS CHANGED (WON / LOST)
           → stage_id mapped to won / lost
        ================================================= */
        'status_changed' => [

            'source_table' => 'leads',

            'preview' => [
                'lead_id'          => 501,
                'name'             => 'Amit Verma',

                'stage_id'         => 4,       // eg: 4=Won, 5=Lost
                'lead_status'      => 'won',    // derived

                'assigned_to_name' => 'Rahul Sharma',
                'remarks'          => 'Deal successfully closed',
            ],

            'email' => [
                'subject' => 'Lead Status Updated',
                'view'    => 'shared::emails.lead.lead-status-changed',
            ],
        ],

        /* =================================================
           PENDING LEADS REMINDER
           → cron based (stage != won/lost)
        ================================================= */
        'pending_reminder' => [

            'source_table' => 'leads',

            'preview' => [
                'assigned_to_name' => 'Rahul Sharma',
                'pending_count'    => 3,

                'leads' => [
                    [
                        'name'   => 'Amit Verma',
                        'mobile' => '+91-9876543210',
                    ],
                    [
                        'name'   => 'Neha Gupta',
                        'mobile' => '+91-9123456789',
                    ],
                ],
            ],

            'email' => [
                'subject' => 'Pending Leads Reminder',
                'view'    => 'shared::emails.lead.pending-leads-reminder',
            ],
        ],

    ],

];
