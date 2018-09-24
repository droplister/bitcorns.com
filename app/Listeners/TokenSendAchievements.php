<?php

namespace App\Listeners;

use App\Token;
use App\Achievements\YouGotMail;
use App\Achievements\PonyExpress;
use App\Achievements\GoingPostal;
use App\Achievements\HighSpeedInternet;
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
            $token->setProgress(new YouGotMail(), $count);        // 1
            $token->setProgress(new PonyExpress(), $count);       // 10
            $token->setProgress(new GoingPostal(), $count);       // 100
            $token->setProgress(new HighSpeedInternet(), $count); // 1000
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