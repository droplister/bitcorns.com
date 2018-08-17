<?php

namespace App\Listeners;

use Droplister\XcpCore\App\Events\CreditWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FarmListener
{
    /**
     * Handle the event.
     *
     * @param  CreditWasCreated  $event
     * @return void
     */
    public function handle(CreditWasCreated $event)
    {
        // Check If First CROPS Credit
        // Create New Farm
    }
}