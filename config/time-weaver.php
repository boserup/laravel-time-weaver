<?php

return [

    'hosts' => [
        'log-all' => env('TIME_WEAVER_LOG_ALL_HOSTS', true),

        /**
         * List of hosts that should be logged, if 'log-all' is false
         */
        'allowed' => [
            // 'api.stripe.com',
            // 'gateway.saxobank.com',
        ],
    ],

    'logger' => \Boserup\LaravelTimeWeaver\Loggers\CloudWatchLogger::class,

    'loggers' => [
        // AWS CloudWatch
        'cloudwatch' => [
            'namespace' => env('TIME_WEAVER_CLOUDWATCH_METRIC_NAMESPACE', 'LaravelTimeWeaver'),
            'name' => env('TIME_WEAVER_CLOUDWATCH_METRIC_NAME', 'ExternalHttpResponseTime'),

            'connection' => [
                'version' => env('AWS_VERSION', 'latest'),
                'region' =>  env('AWS_REGION', 'us-east-1'),
                'credentials' => [
                    'key' => env('CLOUDWATCH_KEY', ''),
                    'secret' => env('CLOUDWATCH_SECRET', ''),
                ]
            ]
        ]
    ]

];
