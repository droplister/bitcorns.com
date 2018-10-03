<?php

namespace App\Listeners;

use App\Farm;
use App\Achievements\BurnBabyBurn;
use Droplister\XcpCore\App\Events\SendWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MonitorSubmissionFees
{
    /**
     * Handle the event.
     *
     * @param  \Droplister\XcpCore\App\Events\SendWasCreated  $event
     * @return void
     */
    public function handle(SendWasCreated $event)
    {
        // Burns Only
        if ($this->isSubmissionFee($event)) {
            // Farms Only
            if ($farm = Farm::where('xcp_core_address', '=', $event->send->source)->first()) {
                // Achievement!
                $farm->unlockIfLocked(new BurnBabyBurn());
            }
        }
    }

    /**
     * Is Submission Fee
     *
     * @param  \Droplister\XcpCore\App\Events\SendWasCreated  $event
     * @return boolean
     */
    private function isSubmissionFee($event)
    {
        return $event->send->status === 'valid' &&
               $event->send->destination === config('bitcorn.subfee_address');
    }
}
