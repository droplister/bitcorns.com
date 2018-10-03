<?php

namespace App\Listeners;

use App\Farm;
use App\Token;
use App\Achievements\TradingCards;
use App\Achievements\AccumulationPhase;
use App\Achievements\MarketManipulation;
use Droplister\XcpCore\App\OrderMatch;
use Droplister\XcpCore\App\Events\OrderMatchWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FarmTradingAchievements
{
    /**
     * Handle the event.
     *
     * @param  \Droplister\XcpCore\App\Events\OrderMatchWasCreated  $event
     * @return void
     */
    public function handle(OrderMatchWasCreated $event)
    {
        // Farms Only / Tokens Only
        if ($this->isFarmAddress($event) && $this->isGameToken($event)) {
            // Relies heavily on BITCORN being defined as a quote asset in the core config.

            // Buyer
            $buyer = Farm::where('xcp_core_address', '=', $event->order_match->trading_buyer_normalized)->first();

            // Seller
            $seller = Farm::where('xcp_core_address', '=', $event->order_match->trading_seller_normalized)->first();

            // Trading Achievements
            if ($this->isSellingForBitcorn($event) && $seller) {
                // Total Bitcorn "Bought"
                $total_traded_for = OrderMatch::where('tx0_address', '=', $seller->xcp_core_address)
                    ->where('backward_asset', '=', config('bitcorn.reward_token'))
                    ->sum('backward_quantity');

                // Progress (Total Traded For)
                $seller->setProgress(new TradingCards(), $total_traded_for);  // 10,000
                $seller->setProgress(new AccumulationPhase(), $total_traded_for);  // 100,000
                $seller->setProgress(new MarketManipulation(), $total_traded_for); // 1,000,000
            }
        }
    }

    /**
     * Is Selling For BITCORN
     *
     * @param  \Droplister\XcpCore\App\Events\OrderMatchWasCreated  $event
     * @return boolean
     */
    private function isSellingForBitcorn($event)
    {
        return $event->order_match->backward_asset === config('bitcorn.reward_token');
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

        return in_array($event->order_match->tx0_address, $farms) ||
            in_array($event->order_match->tx1_address, $farms);
    }

    /**
     * Is Game Token
     *
     * @param  \Droplister\XcpCore\App\Events\OrderMatchWasCreated  $event
     * @return boolean
     */
    private function isGameToken($event)
    {
        $tokens = Token::pluck('xcp_core_asset_name')->toArray();

        return in_array($event->order_match->backward_asset, $tokens) ||
            in_array($event->order_match->forward_asset, $tokens);
    }
}
