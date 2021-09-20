<?php

return [
    'url' => env('APP_URL'),
    'confirmClientPath' => '/client-confirm?slug=',
    'email' => [
        'accountCreated' => [
            'title' => 'New Account @ BrightFM Group'
        ],

        'accountVerified' => [
            'title' => 'Account Verified @ BrightFM Group'
        ]
    ],

    'mailtemplates' => [
        [
            'title' => 'Account Created Notification Mail',
            'slug' => 'SendAccountCreatedNotification',
            'url' => '/api/v1/preview/mailable/SendAccountCreatedNotification'
        ],

        [
            'title' => 'Account Activation Mail',
            'slug' => 'SendAccountActivated',
            'url' => '/api/v1/preview/mailable/SendAccountActivated'
        ],

        [
            'title' => 'Client Created Mail',
            'slug' => 'SendClientCreated',
            'url' => '/api/v1/preview/mailable/SendClientCreated',
        ],

        [
            'title' => 'Send Password Reset Instructions Mail',
            'slug' => 'SendPasswordResetInstructions',
            'url' => '/api/v1/preview/mailable/SendPasswordResetInstructions'
        ],

        [
            'title' => 'Password Reset Successfully Notification Mail',
            'slug' => 'SendPasswordResetSuccessfullyNotification',
            'url' => '/api/v1/preview/mailable/SendPasswordResetSuccessfullyNotification'
        ]
    ]
];
