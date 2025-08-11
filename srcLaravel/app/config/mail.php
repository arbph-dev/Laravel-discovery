<?php

return [

 /* .....................   */

    
    'mailers' => [

        'smtp' => [
            'transport' => 'smtp',
            'scheme' => env('MAIL_SCHEME'),
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', 'IPSRV'),
            'port' => env('MAIL_PORT', PORT ),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url(env('APP_URL', 'http://url'), PHP_URL_HOST)),
        ],
    ],
            /* .....................   */
];
