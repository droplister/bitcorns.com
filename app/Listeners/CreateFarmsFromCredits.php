<?php

namespace App\Listeners;

use App\Jobs\CreateFarm;
use Droplister\XcpCore\App\Events\CreditWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateFarmsFromCredits
{
    /**
     * Handle the event.
     *
     * @param  \Droplister\XcpCore\App\Events\CreditWasCreated  $event
     * @return void
     */
    public function handle(CreditWasCreated $event)
    {
        // Farms Only
        if ($this->isAccessToken($event)) {
            CreateFarm::dispatch($event->credit);
        }
    }

    /**
     * Is Access Token
     *
     * @param  \Droplister\XcpCore\App\Events\CreditWasCreated  $event
     * @return boolean
     */
    private function isAccessToken($event)
    {
        return $event->credit->asset === config('bitcorn.access_token');
    }
}
