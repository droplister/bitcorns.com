<?php

namespace App\Listeners;

use App\Token;
use App\Achievements\Tokens\GenerousBenefactor;
use App\Achievements\Tokens\PermanentCollection;
use Droplister\XcpCore\App\Events\CreditWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MuseumListener
{
    /**
     * Handle the event.
     *
     * @param  CreditWasCreated  $event
     * @return void
     */
    public function handle(CreditWasCreated $event)
    {
        // Museum Only
        if($event->credit->address === config('bitcorn.museum_address'))
        {
            // Game Tokens Only
            if($token = Token::where('xcp_core_asset_name', '=', $event->credit->asset)->first())
            {
                // Record Time
                $token->touchTime('museumed_at');

                // Achievement!
                $token->unlockIfLocked(new PermanentCollection());

                // Achievement!
                $this->generousBenefactors($token, $event);
            }
        }
    }

    /**
     * Generous Benefactors
     *
     * @param  Token  $token
     * @param  CreditWasCreated  $event
     * @return void
     */
    private function generousBenefactors(Token $token, CreditWasCreated $event)
    {
        // Museum Address
        $museum = Farm::findBySlug(config('bitcorn.museum_address'));

        // Total Donations
        $donations = number_format($museum->getTokenBalance($event->credit->asset)->quantity_normalized, 0);

        // Achievement!
        $token->setProgress(new GenerousBenefactor(), $donations);
    }
}