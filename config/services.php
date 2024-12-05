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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    // 'google' => [
    // 'client_id' => '313797940949-h5t95o53946q06qbihqf4a0r63ig4pu3.apps.googleusercontent.com',
    // 'client_secret' => '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',
    // 'redirect' => 'http://localhost:8000/auth/google/callback',
    // ],


    // 'facebook' => [
    // 'client_id' => '909216711303019',
    // 'client_secret' => 'f10cc9b8abe3155d317e1eda4bf3b513',
    // 'redirect' => 'http://localhost:8000/auth/facebook/callback',
    // ],

];
