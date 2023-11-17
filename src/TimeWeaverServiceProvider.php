<?php

namespace Boserup\LaravelTimeWeaver;

use Boserup\LaravelTimeWeaver\Exceptions\NoLoggerDefinedException;
use Boserup\LaravelTimeWeaver\Listeners\RequestResponseReceived;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class TimeWeaverServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/time-weaver.php' => config_path('time-weaver.php')
            ], 'time-weaver-config');
        }

        // Ensure a logger is configured
        if (!data_get($this->app['config'], 'time-weaver.logger')) {
            throw new NoLoggerDefinedException();
        }

        $this->app->bind('time-weaver', fn() => new TimeWeaver());
        Event::listen('Illuminate\Http\Client\Events\ResponseReceived', RequestResponseReceived::class);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/time-weaver.php', 'time-weaver');
    }
}
