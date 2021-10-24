<?php

namespace App\Providers;

use App\Events\CreateChannelEvent;
use App\Events\EmailSenderEvent;
use App\Listeners\CreateChannelListener;
use App\Listeners\EmailSenderListener;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\ExampleEvent::class => [
            \App\Listeners\ExampleListener::class,
        ],
        CreateChannelEvent::class => [
            CreateChannelListener::class
        ],
        EmailSenderEvent::class => [
            EmailSenderListener::class
        ],
    ];
}
