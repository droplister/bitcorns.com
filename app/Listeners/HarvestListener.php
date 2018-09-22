<?php

namespace App\Listeners;

use App\Jobs\HandleHarvest;
use Droplister\XcpCore\App\Events\DividendWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HarvestListener
{
    /**
     * Handle the event.
     *
     * @param  \Droplister\XcpCore\App\Events\DividendWasCreated  $event
     * @return void
     */
    public function handle(DividendWasCreated $event)
    {
        // Harvests Only
        if($this->isHarvest($event))
        {
            HandleHarvest::dispatch($event->dividend);
        }
    }

    /**
     * Is Harvest
     * 
     * @param  \Droplister\XcpCore\App\Events\DividendWasCreated  $event
     * @return boolean
     */
    private function isHarvest($event)
    {
        return $event->dividend->status === 'valid' &&
               $event->dividend->source === config('bitcorn.genesis_address') &&
               $event->dividend->asset === config('bitcorn.access_token') &&
               $event->dividend->dividend_asset === config('bitcorn.reward_token');
    }
}