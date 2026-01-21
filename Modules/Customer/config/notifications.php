<?php

return [

    /* =====================================================
       CUSTOMER MODULE (customers table based)
    ====================================================== */
    'customer' => [

        /* =====================================================
           CUSTOMER CREATED / REGISTERED
        ====================================================== */
        'created' => [

            /* PREVIEW DATA (customers table aligned) */
            'preview' => [
                'id'              => 101,
                'tenant_id'       => 1,
                'business_type'   => 'Retail',
                'customer_type'   => 'B2B',

                // commonPersonFields()
                'name'            => 'Ravi Sharma',
                'email'           => 'ravi@example.com',
                'mobile'          => '9876543210',

                'state'           => 'Uttar Pradesh',
                'district'        => 'Mathura',
                'gstin'           => '09ABCDE1234F1Z5',

                'created_at'      => '2026-01-18 11:30:00',
            ],

            'email' => [
                'subject' => 'New Customer Registered',
                'view'    => 'shared::emails.customer.new-customer-registered',
            ],
        ],

        /* =====================================================
           CUSTOMER UPDATED
        ====================================================== */
        'updated' => [

            'preview' => [
                'id'            => 101,
                'tenant_id'     => 1,
                'name'          => 'Ravi Sharma',
                'email'         => 'ravi@example.com',
                'mobile'        => '9876543210',
                'updated_at'    => '2026-01-20 15:10:00',
            ],

            'email' => [
                'subject' => 'Customer Profile Updated',
                'view'    => 'shared::emails.customer.customer-updated',
            ],
        ],

        /* =====================================================
           CUSTOMER FOLLOW-UP / NEXT DATE REMINDER
        ====================================================== */
        'followup_reminder' => [

            'preview' => [
                'id'          => 101,
                'name'        => 'Ravi Sharma',
                'mobile'      => '9876543210',
                'next_date'   => '2026-01-25',
                'reference'   => 'Interested in annual plan',
            ],

            'email' => [
                'subject' => 'Customer Follow-up Reminder',
                'view'    => 'shared::emails.customer.followup-reminder',
            ],
        ],

        /* =====================================================
           CUSTOMER STATUS CHANGED
        ====================================================== */
        'status_changed' => [

            'preview' => [
                'id'          => 101,
                'name'        => 'Ravi Sharma',
                'old_status'  => 'inactive',
                'new_status'  => 'active',
                'updated_at'  => '2026-01-22 10:45:00',
            ],

            'email' => [
                'subject' => 'Customer Status Updated',
                'view'    => 'shared::emails.customer.customer-status-changed',
            ],
        ],
    ],
];
