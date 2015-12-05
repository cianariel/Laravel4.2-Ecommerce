<?php

    namespace App\Providers;

    use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
    use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
    use App\Events\SendActivationMail;
    use App\Handlers\Events\SendActivationMailHandler;
    use App\Handlers\Events\SendPasswordResetEmailHandler;

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
                SendActivationMailHandler::class,
                SendPasswordResetEmailHandler::class
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
