<?php

namespace LaravelTimeWeaverTests;

use Orchestra\Testbench\TestCase;
use Boserup\LaravelTimeWeaver\Contracts\LoggerContract;
use Boserup\LaravelTimeWeaver\TimeWeaver;

class TimeWeaverTest extends TestCase
{
    public function testItForwardsToLogger(): void
    {
        $fakeLogger = $this->mock(LoggerContract::class)
            ->shouldReceive('log')
            ->withArgs(['foo.bar', 0.250])
            ->once();

        $this->app['config']->set('time-weaver.logger', LoggerContract::class);
        $this->app->bind(LoggerContract::class, fn() => $fakeLogger->getMock());

        (new TimeWeaver())->log('foo.bar', 0.250);
    }
}
