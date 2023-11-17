<?php

namespace Boserup\LaravelTimeWeaver\Loggers;

use Aws\CloudWatch\CloudWatchClient;
use Boserup\LaravelTimeWeaver\Contracts\LoggerContract;

class CloudWatchLogger implements LoggerContract
{
    public function log(string $hostname, float $time): void
    {
        $client = new CloudWatchClient(config('time-weaver.loggers.cloudwatch.connection'));
        $client->putMetricData([
            'Namespace' => config('time-weaver.loggers.cloudwatch.namespace', 'LaravelTimeWeaver'),
            'MetricData' => [
                [
                    'MetricName' => config('time-weaver.loggers.cloudwatch.name', 'ExternalHttpResponseTime'),
                    'Timestamp' => time(),
                    'Value' => $time,
                    'Unit' => 'Seconds',
                    'Dimensions' => [
                        [
                            'Name' => 'HostName',
                            'Value' => $hostname
                        ],
                    ]
                ]
            ],
        ]);
    }
}
