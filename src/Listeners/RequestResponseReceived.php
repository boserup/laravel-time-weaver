<?php

namespace Boserup\LaravelTimeWeaver\Listeners;

use Boserup\LaravelTimeWeaver\Facades\TimeWeaver;
use Illuminate\Http\Client\Events\ResponseReceived;

class RequestResponseReceived
{
    public function handle(ResponseReceived $event): void
    {
        TimeWeaver::log(
            $event->request->toPsrRequest()->getUri()->getHost(),
            $event->response->transferStats->getTransferTime()
        );
    }
}
