<?php

namespace App\Listeners;

use Droplister\XcpCore\App\Events\BalanceWasUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NoCropsListener
{
    /**
     * Handle the event.
     *
     * @param  BalanceWasUpdated  $event
     * @return void
     */
    public function handle(BalanceWasUpdated $event)
    {
        // Check If First CROPS Credit
        // Create New Farm
    }
}