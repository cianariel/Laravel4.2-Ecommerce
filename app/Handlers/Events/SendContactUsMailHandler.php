<?php

    namespace App\Handlers\Events;

    use App\Events\SendContactUsMail;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Queue\ShouldQueue;

    class SendContactUsMailHandler {

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
         * @param SendContactUsMail|SendActivationMail|SendPasswordResetEmail $event
         */
        public function handle(SendContactUsMail $event)
        {
            \Mail::send('email.welcome',
                [
                    'name' => $event->name,
                    'email' => $event->email,
                    'type' => $event->type,
                    'message' => $event->message,

                ],
                function ($message) use ($event)
                {
                    $message->to(env('CONTACT_MAIL_TO'), $event->name)
                        ->from($event->email)
                        ->subject("Ideaing - Contact Us Query");
                });

            // dd($event);
        }
    }
