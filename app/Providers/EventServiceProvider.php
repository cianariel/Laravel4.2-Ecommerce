<?php

    namespace App\Providers;

    use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
    use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
    use App\Events\SendActivationMail;
    use App\Handlers\Events\SendActivationMailHandler;
    use App\Events\SendResetEmail;
    use App\Handlers\Events\SendResetEmailHandler;


    class EventServiceProvider extends ServiceProvider {

        /**
         * The event listener mappings for the application.
         *
         * @var array
         */
        protected $listen = [
            'App\Events\SomeEvent'    => [
                'App\Listeners\EventListener',
            ],
            SendActivationMail::class => [
                SendActivationMailHandler::class
            ],
            SendResetEmail::class => [
                SendResetEmailHandler::class
            ]

        ];

        /**
         * Register any other events for your application.
         *
         * @param  \Illuminate\Contracts\Events\Dispatcher $events
         * @return void
         */
        public function boot(DispatcherContract $events)
        {
            parent::boot($events);

            //
        }
    }
