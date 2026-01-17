<?php

return [

    'employee' => [

        /* =================================================
           EMPLOYEE BIRTHDAY WISH
        ================================================= */
        'birthday_wish' => [
            'source_table' => 'employees',
            'preview' => [
                'employee_id'   => 101,
                'name'          => 'Rahul Sharma',
                'email'         => 'rahul@company.com',
                'date_of_birth' => '1994-01-18',
                'designation'   => 'Software Engineer',
            ],
            'email' => [
                'subject' => 'Happy Birthday {{ name }}!',
                'view'    => 'shared::emails.employee.birthday-wish',
            ],
        ],

        /* =================================================
           EMPLOYEE ADDED / REMOVED
        ================================================= */
        'status_changed' => [
            'source_table' => 'employees',
            'preview' => [
                'employee_id'       => 101,
                'name'              => 'Rahul Sharma',
                'email'             => 'rahul@company.com',
                'employee_type'     => 'Permanent',
                'designation'       => 'Software Engineer',
                'status'            => 'added', // added | removed
                'effective_date'    => '2026-01-15',
                'date_of_joining'   => '2026-01-15',
                'date_of_relieving' => null,
            ],
            'email' => [
                'subject' => 'Employee {{ status | ucfirst }}',
                'view'    => 'shared::emails.employee.employee-status',
            ],
        ],

        /* =================================================
           SALARY PAID
        ================================================= */
        'salary_paid' => [
            'source_table' => 'employees',
            'preview' => [
                'employee_id'         => 101,
                'name'                => 'Rahul Sharma',
                'email'               => 'rahul@company.com',
                'designation'         => 'Software Engineer',
                'salary_month'        => 'January 2026',
                'salary_amount'       => 42000.00,
                'payment_date'        => '2026-01-31',
                'payment_mode'        => 'Bank Transfer',
                'bank_name'           => 'HDFC Bank',
                'bank_account_number' => 'XXXXXX3456',
                'bank_ifsc_code'      => 'HDFC0001234',
            ],
            'email' => [
                'subject' => 'Salary Paid: {{ salary_month }}',
                'view'    => 'shared::emails.employee.salary-paid',
            ],
        ],

        /* =================================================
           TASK ASSIGNED
        ================================================= */
        'task_assigned' => [
            'source_table' => 'employees',
            'preview' => [
                'employee_id'      => 101,
                'name'             => 'Rahul Sharma',
                'email'            => 'rahul@company.com',
                'designation'      => 'Software Engineer',
                'task_title'       => 'Prepare Monthly Report',
                'task_description' => 'Prepare January performance report.',
                'assigned_by'      => 'Project Manager',
                'due_date'         => '2026-01-20',
                'job_location'     => 'Noida Office',
            ],
            'email' => [
                'subject' => 'New Task Assigned: {{ task_title }}',
                'view'    => 'shared::emails.employee.task-assigned',
            ],
        ],
    ],

    /* =====================================================
       EVENT MODULE
       → Event Updated / Cancelled
    ===================================================== */
    'event' => [

        'status_changed' => [

            'source_table' => 'events',

            'preview' => [
                'event_id'    => 201,
                'event_title' => 'Annual Staff Meeting',
                'event_date'  => '2026-02-05',
                'event_time'  => '11:00 AM',
                'status'      => 'updated', // updated | cancelled
                'details'     => 'Meeting time changed to 11:00 AM',

                // Optional: participants (employees / users)
                'participants' => [
                    [
                        'type'  => 'Employee',
                        'id'    => 101,
                        'name'  => 'Rahul Sharma',
                        'email' => 'rahul@company.com',
                    ],
                    [
                        'type'  => 'Employee',
                        'id'    => 102,
                        'name'  => 'Anita Verma',
                        'email' => 'anita@company.com',
                    ],
                ],
            ],

            'email' => [
                'subject' => '{{ status == "cancelled" ? "Event Cancelled: " : "Event Updated: " }}{{ event_title }}',
                'view'    => 'shared::emails.event.event-status',
            ],
        ],
    ],
];
