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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],
    'ad_portal_url' => env('AD_PORTAL_URL'),
    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'aws_apigateway' => [
        'access_key'    => env('AWS_ACCESS_KEY_ID'),
        'secret_key'    => env('AWS_SECRET_ACCESS_KEY'),
        'region'        => env('AWS_DEFAULT_REGION', 'us-east-1'),
        'usage_plan_id' => env('AWS_USAGE_PLAN_ID'),
    ],
    'google_places' => [
        'key' => env('GOOGLE_PLACES_KEY'),
    ],
    'stripe' => [
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'stripe_prices' => [
        'GBP' => [
            'test' => env('STRIPE_PRICE_GBP_TEST'),
            'live' => env('STRIPE_PRICE_GBP_LIVE'),
        ],
        'USD' => [
            'test' => env('STRIPE_PRICE_USD_TEST'),
            'live' => env('STRIPE_PRICE_USD_LIVE'),
        ],
        'CAD' => [
            'test' => env('STRIPE_PRICE_CAD_TEST'),
            'live' => env('STRIPE_PRICE_CAD_LIVE'),
        ],
        'AUD' => [
            'test' => env('STRIPE_PRICE_AUD_TEST'),
            'live' => env('STRIPE_PRICE_AUD_LIVE'),
        ],
    ],
    'twilio' => [
        'sid' => env('TWILIO_ACCOUNT_SID'),
        'token' => env('TWILIO_AUTH_TOKEN'),
        'from' => env('TWILIO_PHONE_NUMBER'),
    ],
];
