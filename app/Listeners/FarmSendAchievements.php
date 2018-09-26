<?php

namespace App\Listeners;

use App\Farm;
use App\Token;
use App\Achievements\HighClass;
use Droplister\XcpCore\App\Events\SendWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FarmSendAchievements
{
    /**
     * Handle the event.
     *
     * @param  \Droplister\XcpCore\App\Events\SendWasCreated  $event
     * @return void
     */
    public function handle(SendWasCreated $event)
    {
        // Farms Only / Tokens Only
        if($this->isFarmAddress($event) && $this->isGameToken($event))
        {
            // Source
            $source = Farm::where('xcp_core_address', '=', $event->send->source)->first();

            // Destination
            $destination = Farm::where('xcp_core_address', '=', $event->send->destination)->first();

            // Token
            $token = Token::where('xcp_core_asset_name', '=', $event->send->asset)->first();

            // High Class
            if($this->isBuyingCrops($event))
            {
                // Achievement!
                $destination->unlockIfLocked(new HighClass());
            }
        }
    }

    /**
     * Is Buying CROPS
     * 
     * @param  \Droplister\XcpCore\App\Events\SendWasCreated  $event
     * @return boolean
     */
    private function isBuyingCrops($event)
    {
        // Decode Memo
        $memo = hex2bin($event->send->memo);

        return $event->send->asset === config('bitcorn.access_token') &&
            $event->send->source === config('bitcorn.genesis_address') &&
            $memo === 'Delivered';
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

        return in_array($event->send->destination, $farms) || in_array($event->send->source, $farms);
    }

    /**
     * Is Game Token
     *
     * @param  \Droplister\XcpCore\App\Events\SendWasCreated  $event
     * @return boolean
     */
    private function isGameToken($event)
    {
        $tokens = Token::pluck('xcp_core_asset_name')->toArray();

        return in_array($event->send->asset, $tokens);
    }
}