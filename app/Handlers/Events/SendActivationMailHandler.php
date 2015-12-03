<?php

namespace App\Handlers\Events;

use App\Events\SendActivationMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendActivationMailHandler
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
     * @param  SendActivationMail  $event
     * @return void
     */
    public function handle(SendActivationMail $event)
    {
        //
    }
}
