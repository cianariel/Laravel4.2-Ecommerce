<?php

namespace App\Handlers\Events;

use App\Events\SendPasswordResetEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPasswordResetEmailHandler
{

    /**
     * Create the event handler.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendPasswordResetEmail  $event
     * @return void
     */
    public function handle(SendPasswordResetEmail $event)
    {
        dd("in");
        dd($event);
        \Mail::send('email.password-reset',
            [
                'code' => $event->code
            ],
            function ($message) use ($event)
            {
                $message->to($event->email, $event->name)
                    ->from(env('MAIL_FROM'))
                    ->subject("Ideaing - Password reset request.");
            });

        //
    }
}
