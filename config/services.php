<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Resend, Postmark, AWS, and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

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

    'exchange_rates' => [
        'provider' => env('EXCHANGE_RATE_PROVIDER', 'frankfurter'),
        'timeout' => (int) env('EXCHANGE_RATE_TIMEOUT', 10),
        'ssl_verify' => filter_var(env('EXCHANGE_RATE_SSL_VERIFY', false), FILTER_VALIDATE_BOOLEAN),
        'base_currency' => env('EXCHANGE_RATE_BASE_CURRENCY', 'USD'),
        'providers' => [
            'frankfurter' => [
                'name' => 'Frankfurter API',
                'api_url' => env('FRANKFURTER_API_URL', 'https://api.frankfurter.dev/v1/latest'),
                'fallback_api_url' => env('FRANKFURTER_FALLBACK_API_URL', 'https://api.frankfurter.app/latest'),
            ],
            'fawaz_ahmed' => [
                'name' => 'Fawaz Ahmed Currency API',
                'api_url' => env('FAWAZ_AHMED_API_URL', 'https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/usd.json'),
                'fallback_api_url' => env('FAWAZ_AHMED_FALLBACK_API_URL', 'https://latest.currency-api.pages.dev/v1/currencies/usd.json'),
            ],
        ],
    ],
];
