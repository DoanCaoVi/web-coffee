<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '1719140898252601',  //client face của bạn
        'client_secret' => 'e4ace1e628a66c3772f3951e2fa14885',  //client app service face của bạn
        'redirect' => 'http://localhost/shopbanhang/admin/callback' //callback trả về
    ],

    'google' => [
        'client_id' => '177819999016-hvkfq9gv6rrq3mp8u3viba7lv75ddqdc.apps.googleusercontent.com',
        'client_secret' => 'jgEC8qC-P9XZU2Nv79cjPm-j',
        'redirect' => 'https://doanvi.com/shopbanhang/google/callback' 
    ],

];
