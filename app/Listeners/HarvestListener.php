<?php

namespace App\Listeners;

use Droplister\XcpCore\App\Events\DividendWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HarvestListener
{
    /**
     * Handle the event.
     *
     * @param  DividendWasCreated  $event
     * @return void
     */
    public function handle(DividendWasCreated $event)
    {
        // Check If Dividend Is Harvest
        // Related Each Farm to Harvest
    }
}