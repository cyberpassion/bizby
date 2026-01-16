<?php

return [

    /* =======================
       BOOKING MODULE
    ======================== */
    'booking' => [

        /* =======================
           NEW BOOKING CREATED
        ======================== */
        'new' => [

            /* TABLE-BASED PREVIEW */
            'preview' => [
                'booking_id'        => 1025,                 // bookings.id
                'invoice_number'    => 'INV-1025',           // bookings.invoice_number
                'booking_type'      => 'slot',               // bookings.booking_type
                'start_at'          => '2026-01-18 10:00:00',// bookings.start_at
                'end_at'            => '2026-01-18 11:00:00',// bookings.end_at
                'status'            => 'pending',            // bookings.status

                /* MORPH USER */
                'customer_name'     => 'Ravi Sharma',        // booked_by->name

                /* JSON COLUMNS */
                'invoice_snapshot'  => [
                    'total' => '1200.00',
                ],
                'meta' => [
                    'notes' => 'First time booking',
                ],
            ],

            'email' => [
                'subject' => 'New Booking Received',
                'view'    => 'shared::emails.booking.new-booking',
            ],

            'sms' => [
                'template_id' => 'tmpl_new_booking',
                'message'     => 'New booking {{invoice_number}} created for {{booking_type}}.',
            ],

            'whatsapp' => [
                'template' => 'new_booking',
                'params'   => [
                    'invoice_number',
                    'customer_name',
                    'booking_type',
                    'start_at',
                    'invoice_snapshot.total',
                ],
            ],
        ],

        /* =======================
           BOOKING STATUS UPDATE
        ======================== */
        'status' => [

            /* TABLE-BASED PREVIEW */
            'preview' => [
                'booking_id'        => 1025,
                'invoice_number'    => 'INV-1025',
                'booking_type'      => 'slot',
                'start_at'          => '2026-01-18 10:00:00',
                'end_at'            => '2026-01-18 11:00:00',
                'status'            => 'cancelled',          // pending | confirmed | cancelled | completed

                'customer_name'     => 'Ravi Sharma',

                /* JSON */
                'meta' => [
                    'notes' => 'Customer requested cancellation',
                ],
            ],

            'email' => [
                'subject' => 'Booking Status Update',
                'view'    => 'shared::emails.booking.booking-status',
            ],

            'sms' => [
                'template_id' => 'tmpl_booking_status',
                'message'     => 'Your booking {{invoice_number}} has been {{status}}.',
            ],

            'whatsapp' => [
                'template' => 'booking_status',
                'params'   => [
                    'customer_name',
                    'invoice_number',
                    'booking_type',
                    'start_at',
                    'status',
                ],
            ],
        ],
    ],
];
