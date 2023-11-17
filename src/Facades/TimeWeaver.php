<?php

namespace Boserup\LaravelTimeWeaver\Facades;

use Illuminate\Support\Facades\Facade;

class TimeWeaver extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'time-weaver';
    }
}
