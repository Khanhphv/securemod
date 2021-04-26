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
        'client_id' => '339679617077663',
        'client_secret' => 'd138a0da1e245a894659bfaf304f9cf9',
        'redirect' => '/login_via_facebook/callback',
    ],
    'discord' => [
        'client_id' => '655358716677193748',
        'client_secret' => 'J0i9tQ5oGEhVLZs1ZkCfHJQNnRf7d795',
        'redirect' => '/login_via_discord/callback',
    ],
    'google' => [
        'client_id' => '177962097889-cldn86e2om81uf5otj6bb7f8bhl051mh.apps.googleusercontent.com',
        'client_secret' => 'VZCTtwwfHBfp5TzDNVcEU7dA',
        'redirect' => '/login_via_google/callback',
    ],
];
