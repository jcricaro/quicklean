<?php

namespace App\Listeners;

use App\Events\JobStatusChange;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyPhone
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
     * @param  JobStatusChange  $event
     * @return void
     */
    public function handle(JobStatusChange $event)
    {
        //
    }
}
