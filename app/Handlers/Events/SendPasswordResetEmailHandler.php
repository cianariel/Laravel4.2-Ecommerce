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
     * @return void
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
        //
    }
}
