<?php

return [

    /* =======================
       CONSULTATION MODULE
    ======================== */
    'consultation' => [

        /* =======================
           CONSULTATION COMPLETED
        ======================== */
        'completed' => [

            /* PREVIEW DATA (as per consultations table) */
            'preview' => [
                'person_name'       => 'Ravi Sharma',
                'consultant_name'   => 'Dr. Amit Verma',
                'consultation_date' => '2026-01-15',
                'consultation_time' => '16:00',
                'channel'           => 'Online',
                'consultation_type' => 'Video',
                'consultation_fee'  => '500.00',
                'reason'            => 'Business consultation',
                'next_date'         => '2026-01-22',
            ],

            'email' => [
                'subject' => 'Consultation Completed',
                'view'    => 'shared::emails.consultation.consultation-completed',
            ],

            'sms' => [
                'template_id' => 'tmpl_consultation_completed',
                'message'     => 'Hi {{person_name}}, your {{consultation_type}} consultation on {{consultation_date}} is completed.',
            ],

            'whatsapp' => [
                'template' => 'consultation_completed',
                'params'   => [
                    'person_name',
                    'consultant_name',
                    'consultation_date',
                    'consultation_time',
                    'channel'
                ],
            ],
        ],

        /* =======================
           NEW CONSULTATION SCHEDULED
        ======================== */
        'scheduled' => [

            'preview' => [
                'person_name'       => 'Ravi Sharma',
                'consultant_name'   => 'Dr. Amit Verma',
                'consultation_date' => '2026-01-18',
                'consultation_time' => '11:00',
                'channel'           => 'Online',
                'reason'            => 'Business Consultation',
            ],

            'email' => [
                'subject' => 'New Consultation Scheduled',
                'view'    => 'shared::emails.consultation.new-consultation',
            ],

            'sms' => [
                'template_id' => 'tmpl_new_consultation',
                'message'     => 'Hi {{person_name}}, your consultation on {{consultation_date}} at {{consultation_time}} has been scheduled.',
            ],

            'whatsapp' => [
                'template' => 'consultation_scheduled',
                'params'   => [
                    'person_name',
                    'consultant_name',
                    'consultation_date',
                    'consultation_time',
                    'channel'
                ],
            ],
        ],

        /* =======================
           NEXT CONSULTATION REMINDER
        ======================== */
        'reminder' => [

            'preview' => [
                'person_name'       => 'Ravi Sharma',
                'consultant_name'   => 'Dr. Amit Verma',
                'consultation_date' => '2026-01-20',
                'consultation_time' => '16:00',
                'channel'           => 'Offline',
                'reason'            => 'Follow-up Consultation',
            ],

            'email' => [
                'subject' => 'Reminder: Upcoming Consultation',
                'view'    => 'shared::emails.consultation.next-consultation-reminder',
            ],

            'sms' => [
                'template_id' => 'tmpl_consultation_reminder',
                'message'     => 'Reminder {{person_name}}: your consultation is on {{consultation_date}} at {{consultation_time}}.',
            ],

            'whatsapp' => [
                'template' => 'consultation_reminder',
                'params'   => [
                    'person_name',
                    'consultant_name',
                    'consultation_date',
                    'consultation_time',
                    'channel'
                ],
            ],
        ],
    ],
];

