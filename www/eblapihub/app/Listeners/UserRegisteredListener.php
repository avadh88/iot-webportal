<?php

namespace App\Listeners;

use App\Events\UserRegisteredEvent;
use App\Jobs\UserRegisterdJob;
use App\Mail\UserRegisterd;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UserRegisteredListener
{
    /**
     * Create the event listener.
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
        UserRegisterdJob::dispatch($event);
        // Mail::to($event->email)->send(new UserRegisterd());
    }
}
