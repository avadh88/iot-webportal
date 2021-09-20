<?php

namespace App\Listeners;

use App\Events\UserRegisteredEvent;
use App\Jobs\AddDeviceJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeviceRegisteredListener
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
     * @param  UserRegisteredEvent  $event
     * @return void
     */
    public function handle($event)
    {
        //
        AddDeviceJob::dispatch($event);
    }
}
