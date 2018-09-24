<?php

namespace App\Listeners;

use App\Token;
use App\Achievements\Tokens\MyFirstHodler;
use App\Achievements\Tokens\ATokensDozen;
use App\Achievements\Tokens\ThreeHundred;
use App\Achievements\Tokens\PopularityContest;
use Droplister\XcpCore\App\Events\BalanceWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TokenBalanceAchievements
{
    /**
     * Handle the event.
     *
     * @param  \Droplister\XcpCore\App\Events\BalanceWasCreated  $event
     * @return void
     */
    public function handle(BalanceWasCreated $event)
    {
        // Tokens Only
        if($this->isGameToken($event))
        {
            // The Token
            $token = Token::where('xcp_core_asset_name', '=', $event->balance->asset)->first();

            // Holders #
            $count = $token->allBalances()->count();

            // Progress (Holders Count)
            $token->setProgress(MyFirstHodler, $count);     // 1
            $token->setProgress(ATokensDozen, $count);      // 13
            $token->setProgress(ThreeHundred, $count);      // 300
            $token->setProgress(PopularityContest, $count); // 1000
        }
    }

    /**
     * Is Game Token
     *
     * @param  \Droplister\XcpCore\App\Events\BalanceWasCreated  $event
     * @return boolean
     */
    private function isGameToken($event)
    {
        $tokens = Token::pluck('xcp_core_asset_name');

        return in_array($event->balance->asset, $tokens);
    }
}