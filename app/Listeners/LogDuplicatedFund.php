<?php

namespace App\Listeners;

use App\Events\DuplicatedFund;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogDuplicatedFund
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DuplicatedFund $event): void
    {
        dd('event');
        // Hadle event
    }
}
