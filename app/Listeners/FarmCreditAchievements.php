<?php

namespace App\Listeners;

use App\Farm;
use App\Achievements\Cornucopia;
use App\Achievements\FarmersMarket;
use App\Achievements\CornFlowethOver;
use Droplister\XcpCore\App\Events\CreditWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FarmCreditAchievements
{
    /**
     * Handle the event.
     *
     * @param  \Droplister\XcpCore\App\Events\CreditWasCreated  $event
     * @return void
     */
    public function handle(CreditWasCreated $event)
    {
        // Bitcorn & Farms Only
        if($this->isBitcorn($event) && $this->isFarmAddress($event))
        {
            // Farm
            $farm = Farm::where('xcp_core_address', '=', $event->credit->address)->first();

            // Surplus
            $surplus = $farm->total_harvested !== 0 ? $farm->rewardBalance()->quantity - $farm->total_harvested : 0;
            if($surplus < 0) $surplus = 0;

            // Progress (Bitcorn Surplus)
            $farm->setProgress(new FarmersMarket(), $surplus);   // 1,000
            $farm->setProgress(new Cornucopia(), $surplus);      // 10,000
            $farm->setProgress(new CornFlowethOver(), $surplus); // 100,000
        }
    }

    /**
     * Is Farm Address
     *
     * @param  \Droplister\XcpCore\App\Events\SendWasCreated  $event
     * @return boolean
     */
    private function isFarmAddress($event)
    {
        $farms = Farm::pluck('xcp_core_address')->toArray();

        return in_array($event->credit->address, $farms);
    }

    /**
     * Is Bitcorn
     *
     * @param  \Droplister\XcpCore\App\Events\SendWasCreated  $event
     * @return boolean
     */
    private function isBitcorn($event)
    {
        return $event->credit->asset === config('bitcorn.reward_token');
    }
}