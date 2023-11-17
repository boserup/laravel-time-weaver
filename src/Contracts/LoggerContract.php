<?php

namespace Boserup\LaravelTimeWeaver\Contracts;

interface LoggerContract
{
    public function log(string $hostname, float $time): void;
}
