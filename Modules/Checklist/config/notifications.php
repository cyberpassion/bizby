<?php

return [

    /* =====================================================
       CHECKLIST MODULE (cyp_checklist)
    ====================================================== */
    'checklist' => [

        /* =====================================================
           NEW CHECKLIST CREATED
           Table: checklists
        ====================================================== */
        'created' => [

            'preview' => [
                'checklist_id'          => 101,                         // checklists.id
                'checklist_name'        => 'Daily Opening Checklist',   // checklists.checklist_name
                'checklist_description' => 'Steps to open office',
                'listing_id'            => 12,                          // checklist_listings.id
                'is_sequence_to_follow' => 'yes',
                'status'                => 'active',                   // commonSaasFields
                'created_by'            => 'Ravi Sharma',              // commonSaasFields
            ],

            'email' => [
                'subject' => 'New Checklist Created',
                'view'    => 'shared::emails.checklist.created',
            ],

            'sms' => [
                'template_id' => 'tmpl_checklist_created',
                'message'     => 'Checklist "{{checklist_name}}" has been created.',
            ],

            'whatsapp' => [
                'template' => 'checklist_created',
                'params'   => [
                    'checklist_name',
                    'created_by',
                ],
            ],
        ],

        /* =====================================================
           CHECKLIST COMPLETED
           Table: checklists + checklist_points
        ====================================================== */
        'completed' => [

            'preview' => [
                'checklist_id'          => 101,
                'checklist_name'        => 'Daily Opening Checklist',
                'listing_id'            => 12,
                'completed_by'          => 'Akanksha Sharma',   // checklist_by
                'checklist_by_type'     => 'User',
                'completed_at'          => '2026-01-18',        // updated_at
                'status_remark'         => 'All points done',
            ],

            'email' => [
                'subject' => 'Checklist Completed',
                'view'    => 'shared::emails.checklist.completed',
            ],

            'sms' => [
                'template_id' => 'tmpl_checklist_completed',
                'message'     => 'Checklist "{{checklist_name}}" is completed.',
            ],

            'whatsapp' => [
                'template' => 'checklist_completed',
                'params'   => [
                    'checklist_name',
                    'completed_by',
                    'completed_at',
                ],
            ],
        ],
    ],

    /* =====================================================
       CHECKLIST POINTS (cyp_checklist_point)
    ====================================================== */
    'checklist_points' => [

        /* =====================================================
           NEW CHECKLIST POINT ASSIGNED
           Table: checklist_points
        ====================================================== */
        'assigned' => [

            'preview' => [
                'checklist_id'                 => 101,
                'listing_id'                   => 12,
                'listing_point_id'             => 55,
                'listing_point_assigned_to'    => 'Ravi Sharma',
                'checklist_description'        => 'Switch on all systems',
                'listing_point_status'         => 0,   // pending
            ],

            'email' => [
                'subject' => 'New Checklist Task Assigned',
                'view'    => 'shared::emails.checklist.point-assigned',
            ],

            'sms' => [
                'template_id' => 'tmpl_checklist_point_assigned',
                'message'     => 'New checklist task assigned to you.',
            ],

            'whatsapp' => [
                'template' => 'checklist_point_assigned',
                'params'   => [
                    'listing_point_assigned_to',
                    'checklist_id',
                ],
            ],
        ],

        /* =====================================================
           CHECKLIST POINT COMPLETED
        ====================================================== */
        'completed' => [

            'preview' => [
                'checklist_id'          => 101,
                'listing_point_id'      => 55,
                'listing_point_status'  => 1,   // completed
                'updated_at'            => '2026-01-18 10:30',
            ],

            'email' => [
                'subject' => 'Checklist Task Completed',
                'view'    => 'shared::emails.checklist.point-completed',
            ],

            'sms' => [
                'template_id' => 'tmpl_checklist_point_completed',
                'message'     => 'A checklist task has been completed.',
            ],

            'whatsapp' => [
                'template' => 'checklist_point_completed',
                'params'   => [
                    'checklist_id',
                    'listing_point_id',
                ],
            ],
        ],
    ],

    /* =====================================================
       PENDING TASK REMINDERS
       Source: checklist_points
    ====================================================== */
    'tasks' => [

        'pending' => [

            'preview' => [
                'checklist_id'              => 101,
                'listing_id'                => 12,
                'listing_point_id'          => 55,
                'listing_point_assigned_to' => 'Ravi Sharma',
                'point_name'                => 'Switch on all systems',
                'point_start_time'          => '09:00',
                'point_end_time'            => '09:15',
                'listing_point_status'      => 0,
            ],

            'email' => [
                'subject' => 'Pending Checklist Task',
                'view'    => 'shared::emails.tasks.pending-checklist-task',
            ],

            'sms' => [
                'template_id' => 'tmpl_pending_checklist_task',
                'message'     => 'You have a pending checklist task.',
            ],

            'whatsapp' => [
                'template' => 'pending_checklist_task',
                'params'   => [
                    'listing_point_assigned_to',
                    'point_name',
                ],
            ],
        ],
    ],
];
