<?php

namespace App\Listeners;

use App\Jobs\CreateFarm;
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
        if($event->credit->asset === config('bitcorn.access_token'))
        {
            CreateFarm::dispatch($event->credit);
        }
    }
}
