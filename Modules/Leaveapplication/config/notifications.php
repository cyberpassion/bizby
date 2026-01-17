<?php

return [

    'leaveapplication' => [

        /* =================================================
           NEW LEAVE APPLICATION SUBMITTED
           → approval_status = pending
        ================================================= */
        'submitted' => [

            'source_table' => 'leaveapplications',

            'preview' => [
                'leaveapplication_id' => 501,

                // entity applying for leave (Employee / Student / User)
                'entity_type'   => 'Employee',
                'entity_id'     => 101,
                'entity_name'   => 'Rahul Sharma',
                'entity_email'  => 'rahul@company.com',

                // leave period
                'start_date'    => '2026-02-10',
                'end_date'      => '2026-02-12',

                // granularity
                'type'          => 'full_day',      // full_day | half_day | session
                'session_ref'   => null,             // Morning / Period 3 etc.

                // classification
                'leave_code'    => 'casual',

                // reason
                'reason'        => 'Personal work',

                // workflow
                'approval_status' => 'pending',
                'applied_at'      => '2026-02-01 11:30:00',
            ],

            'email' => [
                'subject' => 'New Leave Application Submitted',
                'view'    => 'shared::emails.leave.new-leave-request',
            ],
        ],

        /* =================================================
           LEAVE STATUS UPDATED
           → approved / rejected / cancelled
        ================================================= */
        'status_updated' => [

            'source_table' => 'leaveapplications',

            'preview' => [
                'leaveapplication_id' => 501,

                // entity
                'entity_type'   => 'Employee',
                'entity_id'     => 101,
                'entity_name'   => 'Rahul Sharma',
                'entity_email'  => 'rahul@company.com',

                // leave info
                'start_date'    => '2026-02-10',
                'end_date'      => '2026-02-12',
                'type'          => 'full_day',
                'leave_code'    => 'casual',

                // approval
                'approval_status' => 'approved', // approved | rejected | cancelled
                'remarks'         => 'Approved by HR',

                // approver
                'approved_by_type'=> 'User',
                'approved_by_id'  => 5,
                'approved_by_name'=> 'HR Manager',
                'approved_at'     => '2026-02-03 14:20:00',

                // attendance impact
                'affects_attendance' => true,
            ],

            'email' => [
                'subject' => 'Leave Application {{ approval_status | ucfirst }}',
                'view'    => 'shared::emails.leave.leave-status',
            ],
        ],

    ],

];
