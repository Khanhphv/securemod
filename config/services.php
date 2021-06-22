<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],
    'facebook' => [
//        'client_id' => '568362147278928',
//        'client_secret' => '082780df3abc8b2b34b43befb0fdba0c',
        'client_id' => '777115459460312',
        'client_secret' => 'c2c703bacc1c3c3dee0c247b326b3b5a',
        'redirect' => 'https://divinesofts.net/login_via_facebook/callback',
    ],
    'discord' => [
        'client_id' => '655358716677193748',
        'client_secret' => 'J0i9tQ5oGEhVLZs1ZkCfHJQNnRf7d795',
        'redirect' => 'https://divinesofts.net/login_via_discord/callback',
    ],
    'google' => [
        'client_id' => '177962097889-3kvfud4798up8cbm89hjl35i63ict3h1.apps.googleusercontent.com',
        'client_secret' => 'wKKRU2VELpUeyrMlMfqd4WlD',
        'redirect' => 'https://divinesofts.net/login_via_google/callback',
    ],
];
