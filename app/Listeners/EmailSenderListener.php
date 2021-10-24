<?php

namespace App\Listeners;


use App\Events\EmailSenderEvent;
use Illuminate\Support\Facades\Mail;

class EmailSenderListener
{
    /**
     * Handle the event.
     *
     * @param EmailSenderEvent $event
     * @return void
     */
    public function handle(EmailSenderEvent $event)
    {
        Mail::send("mail", $event->data, function ($message) use ($event) {
            $message->to($event->users["email"], $event->users["username"])->subject("Reset Password");
        });
    }
}
