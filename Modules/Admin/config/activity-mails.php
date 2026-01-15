<?php

return [
    'auth' => [

        'login' => [
            'otp' => [

                /* PREVIEW DATA */
                'preview' => [
                    'name' => 'Ravi Sharma',
                    'otp'  => '1234',
                ],

                /* EMAIL */
                'email' => [
                    'subject' => 'Your Login OTP',
                    'view'    => 'admin::emails.auth.login-otp',
                ],

                /* SMS (India DLT) */
                'sms' => [
                    'template_id' => 'abc',
                    'message'     => 'Hi {{name}}, your OTP is {{otp}}',
                ],

                /* WHATSAPP */
                'whatsapp' => [
                    'template' => 'auth_login_otp',
                    'params'   => ['name', 'otp'],
                ],
            ],
        ],

        /* =======================
           ACCOUNT LOCKED
        ======================== */
        'account_locked' => [

            'preview' => [
                'name' => 'Ravi Sharma',
            ],

            'email' => [
                'subject' => 'Account Locked',
                'view'    => 'admin::emails.auth.account-locked',
            ],

            'sms' => [
                'template_id' => 'xyz',
                'message'     => 'Hi {{name}}, your account has been locked due to multiple failed login attempts.',
            ],

            'whatsapp' => [
                'template' => 'auth_account_locked',
                'params'   => ['name'],
            ],
        ],

        /* =======================
           EMAIL VERIFICATION
        ======================== */
        'email_verification' => [

            'preview' => [
                'name'      => 'Ravi Sharma',
                'verifyUrl'=> 'https://example.com/verify',
            ],

            'email' => [
                'subject' => 'Verify your email',
                'view'    => 'admin::emails.auth.verify-email',
            ],

            'sms' => [
                'template_id' => 'tmpl_verify_email',
                'message'     => 'Hi {{name}}, verify your email: {{verifyUrl}}',
            ],

            'whatsapp' => [
                'template' => 'auth_email_verification',
                'params'   => ['name', 'verifyUrl'],
            ],
        ],

        /* =======================
           FORGOT PASSWORD
        ======================== */
        'forgot_password' => [

            'preview' => [
                'name'     => 'Ravi Sharma',
                'resetUrl'=> 'https://example.com/reset',
            ],

            'email' => [
                'subject' => 'Reset your password',
                'view'    => 'admin::emails.auth.forgot-password',
            ],

            'sms' => [
                'template_id' => 'tmpl_forgot_password',
                'message'     => 'Hi {{name}}, reset your password here: {{resetUrl}}',
            ],

            'whatsapp' => [
                'template' => 'auth_forgot_password',
                'params'   => ['name', 'resetUrl'],
            ],
        ],

        /* =======================
           LOGIN ALERT
        ======================== */
        'login_alert' => [

            'preview' => [
                'name'   => 'Ravi Sharma',
                'ip'     => '192.168.1.1',
                'device' => 'Chrome / Windows',
            ],

            'email' => [
                'subject' => 'New login detected',
                'view'    => 'admin::emails.auth.login-alert',
            ],

            'sms' => [
                'template_id' => 'tmpl_login_alert',
                'message'     => 'Hi {{name}}, new login from {{device}} (IP: {{ip}})',
            ],

            'whatsapp' => [
                'template' => 'auth_login_alert',
                'params'   => ['name', 'ip', 'device'],
            ],
        ],

        /* =======================
           REGISTRATION PENDING
        ======================== */
        'registration_pending' => [

            'preview' => [
                'name'      => 'Ravi Sharma',
                'resumeUrl'=> 'https://example.com/resume',
            ],

            'email' => [
                'subject' => 'Complete your registration',
                'view'    => 'admin::emails.auth.registration-pending',
            ],

            'sms' => [
                'template_id' => 'tmpl_registration_pending',
                'message'     => 'Hi {{name}}, complete your registration: {{resumeUrl}}',
            ],

            'whatsapp' => [
                'template' => 'auth_registration_pending',
                'params'   => ['name', 'resumeUrl'],
            ],
        ],

        /* =======================
           REGISTRATION CONFIRMATION
        ======================== */
        'registration_confirmation' => [

            'preview' => [
                'name'     => 'Ravi Sharma',
                'loginUrl'=> 'https://example.com/login',
            ],

            'email' => [
                'subject' => 'Welcome to Bizby',
                'view'    => 'admin::emails.auth.registration-confirmation',
            ],

            'sms' => [
                'template_id' => 'tmpl_registration_confirmed',
                'message'     => 'Welcome {{name}}! Login here: {{loginUrl}}',
            ],

            'whatsapp' => [
                'template' => 'auth_registration_confirmation',
                'params'   => ['name', 'loginUrl'],
            ],
        ],
    ],
    /* =======================
       ADMIN SECTION (ADDED)
    ======================== */
    'admin' => [

        'alert' => [

            'preview' => [
                'content' => 'Server CPU usage is very high. Please check immediately.',
            ],

            'email' => [
                'subject' => 'Admin Alert',
                'view'    => 'admin::emails.admin.alert',
            ],
        ],
    ],
];
