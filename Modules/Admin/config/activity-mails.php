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
                    'template_id' => '1207163467890123456',
                    'message'     => 'Hi {{name}}, your OTP is {{otp}}',
                ],

                /* WHATSAPP */
                'whatsapp' => [
                    'template' => 'auth_login_otp',
                    'params'   => ['name', 'otp'],
                ],
            ],
        ],
    ],
];
