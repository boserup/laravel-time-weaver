<?php

namespace Boserup\LaravelTimeWeaver;

use Aws\CloudWatch\CloudWatchClient;
use Boserup\LaravelTimeWeaver\Contracts\LoggerContract;
use Boserup\LaravelTimeWeaver\Exceptions\NoLoggerDefinedException;

class TimeWeaver implements LoggerContract
{
    public function log(string $hostname, float $time): void
    {
        // Bail early, if the hostname should not be logged
        if (!$this->shouldLogHost($hostname)) {
            return;
        }

        app(config('time-weaver.logger'))
            ->log($hostname, $time);
    }
    protected function shouldLogHost(string $hostname): bool
    {
        return config('time-weaver.hosts.log-all', true)
            ?: in_array($hostname, config('time-weaver.hosts.allowed', []));
    }
}
