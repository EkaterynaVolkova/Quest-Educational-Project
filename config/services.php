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
        'domain' => 'sandbox1c5e871929d64f03bd4b91d7ee4c8865.mailgun.org',
        'secret' => 'key-7ee7d7bccc4cf8b8c1948ac6855cf14b',
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

//    'google' => [
//        'client_id' => '11374064133-7e2ue6meuldi9u2b0eodjssfnussg4ka.apps.googleusercontent.com',
//        'client_secret' => 'if43fpi0KZBI9Rv7r8mWE10E',
//        'redirect' => 'https://quest.challenge.php.a-level.com.ua/public/google/callback',
//    ],

    'google' => [
        'client_id' => '11374064133-7e2ue6meuldi9u2b0eodjssfnussg4ka.apps.googleusercontent.com',
        'client_secret' => 'if43fpi0KZBI9Rv7r8mWE10E',
        'redirect' => 'http://quest/public/google/callback',
    ],

    'facebook' => [
        'client_id' => '186555511901697',
        'client_secret' => '52f3c5c57c8380d5798a3a0e5c31db4f',
        'redirect' => 'http://challenge.loc/callback',
    ],
];
