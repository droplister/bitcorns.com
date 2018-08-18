<?php

namespace App\Listeners;

use App\Farm;
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
        if($event->balance->asset === 'CROPS' && $event->balance->quantity === 0)
        {
            $farm = Farm::where('address', '=', $event->balance->address)->first();

            if($farm)
            {
                // Handle That
            }
        }
    }
}