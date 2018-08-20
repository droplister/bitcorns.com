<?php

namespace App\Listeners;

use App\Token;
use App\Achievements\Tokens\PermanentCollection;
use Droplister\XcpCore\App\Events\SendWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MuseumListener
{
    /**
     * Handle the event.
     *
     * @param  \Droplister\XcpCore\App\Events\SendWasCreated  $event
     * @return void
     */
    public function handle(SendWasCreated $event)
    {
        // Museum Only
        if($this->isMuseumDonation($event))
        {
            // Game Tokens Only
            if($token = Token::where('xcp_core_asset_name', '=', $event->send->asset)->first())
            {
                // Record Time
                $token->touchTime('museumed_at');

                // Achievement!
                $token->unlockIfLocked(new PermanentCollection());
            }
        }
    }

    /**
     * Is Museum Donation
     *
     * @param  \Droplister\XcpCore\App\Events\SendWasCreated  $event
     * @return boolean
     */
    private function isMuseumDonation($event)
    {
        return $event->send->status === 'valid' &&
               $event->send->destination === config('bitcorn.museum_address');
    }
}