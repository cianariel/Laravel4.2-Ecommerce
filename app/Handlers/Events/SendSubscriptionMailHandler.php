<?php

    namespace App\Handlers\Events;

    use App\Events\SendSubscriptionMail;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Queue\ShouldQueue;

    class SendSubscriptionMailHandler {

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
         * @param  SendResetEmail $event
         * @return void
         */
        public function handle(SendSubscriptionMail $event)
        {
            \Mail::send('email.password-reset',
                [
                    'name' => $event->name,
                    'code' => $event->link
                ],
                function ($message) use ($event)
                {
                    $message->to($event->email, $event->name)
                        ->from(env('MAIL_FROM'))
                        ->subject("Ideaing - Password reset request.");
                });
        }
    }
