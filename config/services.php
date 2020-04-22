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
    ],
    
    
    'facebook' => [
    'client_id' => '482020815912632',
    'client_secret' => '8930d69140a975c560c2a97842ef20eb',
    'redirect' => 'https://reviewers.club/vip/callback',
	],
	
	/*
	'facebook' => [
    'client_id' => '420053462155475',
    'client_secret' => 'e47cc42f2ecedcb870244fa4b662010e',
    'redirect' => 'https://reviewers.club/vip/callback',
	],
	*/
	

];
