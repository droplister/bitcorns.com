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
     * @param  \Droplister\XcpCore\App\Events\BalanceWasUpdated  $event
     * @return void
     */
    public function handle(BalanceWasUpdated $event)
    {
        // Farms Only
        if($this->isAccessToken($event))
        {
            // Get Farm
            $farm = Farm::where('xcp_core_address', '=', $event->balance->address)->first();

            // Access Y/N
            $this->updateAccess($farm, $event);

            // Un-Map No Croppers
            if(! $farm->access)
            {
                $farm->mapMarkers()->delete();
            }
        }
    }

    /**
     * Is Access Token
     *
     * @param  \Droplister\XcpCore\App\Events\BalanceWasUpdated  $event
     * @return boolean
     */
    private function isAccessToken($event)
    {
        return $event->balance->asset === config('bitcorn.access_token');
    }

    /**
     * Is Access Token
     *
     * @param  \App\Farm  $farm
     * @param  \Droplister\XcpCore\App\Events\BalanceWasUpdated  $event
     * @return \App\Farm
     */
    private function updateAccess($farm, $event)
    {
        $access = $event->balance->quantity > 0;

        return $farm->update(['access' => $access]);
    }
}