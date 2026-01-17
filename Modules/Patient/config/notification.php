<?php

return [

    'patient' => [

        /* =================================================
           NEW PATIENT ADDED
           → patients table
        ================================================= */
        'new_patient_added' => [

            'source_table' => 'patients',

            'preview' => [
                'patient_id'    => '1',
                'name'          => 'Ravi Sharma',        // Recipient
                'patientName'   => 'John Doe',
                'admission_date'=> '2026-01-17',
                'admission_time'=> '10:30:00',
                'room_number'   => '101',
                'bed_number'    => 'A1',
                'admitted_by_name' => 'Dr. Smith',
            ],

            'email' => [
                'subject' => 'New Patient Added: {{ patientName }}',
                'view'    => 'shared::emails.patient.new-patient-added',
            ],
        ],

        /* =================================================
           PATIENT DISCHARGED
           → patients table
        ================================================= */
        'patient_discharged' => [

            'source_table' => 'patients',

            'preview' => [
                'patient_id'      => '1',
                'name'            => 'Ravi Sharma',        // Recipient
                'patientName'     => 'John Doe',
                'discharge_date'  => '2026-01-20',
                'discharge_time'  => '15:00:00',
                'room_number'     => '101',
                'bed_number'      => 'A1',
                'discharged_by'   => 5,                     // Employee/User ID
            ],

            'email' => [
                'subject' => 'Patient Discharged: {{ patientName }}',
                'view'    => 'shared::emails.patient.patient-discharged',
            ],
        ],

        /* =================================================
           PATIENT PENDING DUES REMINDER
           → patients table
        ================================================= */
        'patient_pending_dues' => [

            'source_table' => 'patients',

            'preview' => [
                'patient_id'    => '1',
                'name'          => 'Ravi Sharma',        // Recipient
                'patientName'   => 'John Doe',
                'dueAmount'     => 2500.00,
                'dueDate'       => '2026-01-25',
            ],

            'email' => [
                'subject' => 'Pending Payment Reminder: {{ patientName }}',
                'view'    => 'shared::emails.patient.patient-pending-dues',
            ],
        ],

        /* =================================================
           PATIENT INFO UPDATED
           → patients table
        ================================================= */
        'patient_updated' => [

            'source_table' => 'patients',

            'preview' => [
                'patient_id'    => '1',
                'name'          => 'Ravi Sharma',        // Recipient
                'patientName'   => 'John Doe',
                'updatedDate'   => '2026-01-17',
            ],

            'email' => [
                'subject' => 'Patient Information Updated: {{ patientName }}',
                'view'    => 'shared::emails.patient.patient-updated',
            ],
        ],

    ],

];
