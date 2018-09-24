<?php

namespace App\Listeners;

use App\Token;
use App\Achievements\MyFirstHodler;
use App\Achievements\ATokensDozen;
use App\Achievements\ThreeHundred;
use App\Achievements\PopularityContest;
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
            $token->setProgress(new MyFirstHodler(), $count);     // 1
            $token->setProgress(new ATokensDozen(), $count);      // 13
            $token->setProgress(new ThreeHundred(), $count);      // 300
            $token->setProgress(new PopularityContest(), $count); // 1000
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
        $tokens = Token::pluck('xcp_core_asset_name')->toArray();

        return in_array($event->balance->asset, $tokens);
    }
}