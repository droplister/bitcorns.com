<?php

namespace App\Listeners;

use App\Token;
use App\Achievements\Tokens\YouGotMail;
use App\Achievements\Tokens\PonyExpress;
use App\Achievements\Tokens\GoingPostal;
use App\Achievements\Tokens\HighSpeedInternet;
use Droplister\XcpCore\App\Events\SendWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TokenSendAchievements
{
    /**
     * Handle the event.
     *
     * @param  \Droplister\XcpCore\App\Events\SendWasCreated  $event
     * @return void
     */
    public function handle(SendWasCreated $event)
    {
        // Tokens Only
        if($this->isGameToken($event))
        {
            // The Token
            $token = Token::where('xcp_core_asset_name', '=', $event->send->asset)->first();

            // Holders #
            $count = $token->sends()->count();

            // Progress (Sends Count)
            $token->setProgress(YouGotMail, $count);        // 1
            $token->setProgress(PonyExpress, $count);       // 10
            $token->setProgress(GoingPostal, $count);       // 100
            $token->setProgress(HighSpeedInternet, $count); // 1000
        }
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