<?php

namespace App\Listeners;

use App\Achievements\Farms\BurnBabyBurn;
use Droplister\XcpCore\App\Events\SendWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubmissionFeeListener
{
    /**
     * Handle the event.
     *
     * @param  \Droplister\XcpCore\App\Events\SendWasCreated  $event
     * @return void
     */
    public function handle(SendWasCreated $event)
    {
        // Submission Fees Only
        if($this->isSubmissionFee($event))
        {
            // Farms Only
            if($farm = Farm::findBySlug($event->send->source))
            {
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
               $event->send->asset === config('bitcorn.reward_token') &&
               $event->send->address === config('bitcorn.subfee_address');
    }
}
