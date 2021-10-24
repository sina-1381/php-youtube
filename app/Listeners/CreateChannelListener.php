<?php

namespace App\Listeners;


use App\Events\CreateChannelEvent;

class CreateChannelListener
{
    /**
     * Handle the event.
     *
     * @param CreateChannelEvent $event
     * @return void
     */
    public function handle(CreateChannelEvent $event)
    {
        $event->users->channels()->create([
            "name" => $event->users->username
        ]);
    }
}
