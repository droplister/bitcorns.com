<?php

namespace App\Listeners;

use App\Token;
use Droplister\XcpCore\App\OrderMatch;
use App\Achievements\CardForACard;
use App\Achievements\InsiderTrading;
use App\Achievements\OpenForBusiness;
use App\Achievements\MerchantAdoption;
use App\Achievements\TechnicalAnalysis;
use App\Achievements\HighFrequencyTrading;
use Droplister\XcpCore\App\Events\OrderMatchWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TokenTradingAchievements
{
    /**
     * Handle the event.
     *
     * @param  \Droplister\XcpCore\App\Events\OrderMatchWasCreated  $event
     * @return void
     */
    public function handle(OrderMatchWasCreated $event)
    {
        // Tokens Only
        if($this->isGameToken($event))
        {
            // Get Tokens
            $tokens = $this->getTokens($event);

            // Self-Trade
            if($event->order_match->tx0_address === $event->order_match->tx1_address)
            {
                foreach($tokens as $token)
                {
                    // Achievement!
                    $token->unlockIfLocked(new InsiderTrading());
                }
            }

            // Card 4 Card
            if(count($tokens) === 2 && $tokens[0]->type === 'upgrade' && $tokens[1]->type === 'upgrade')
            {
                foreach($tokens as $token)
                {
                    // Achievement!
                    $token->unlockIfLocked(new CardForACard());
                }
            }

            // Progress (Trade Count)
            foreach($tokens as $token)
            {
                // Trade Count
                $count = OrderMatch::where('backward_asset', '=', $token->xcp_core_asset_name)
                    ->orWhere('forward_asset', '=', $token->xcp_core_asset_name)
                    ->count();

                // Set Progress
                $token->setProgress(new OpenForBusiness(), $count);       // 1
                $token->setProgress(new TechnicalAnalysis(), $count);     // 9
                $token->setProgress(new MerchantAdoption(), $count);      // 100
                $token->setProgress(new HighFrequencyTrading(), $count);  // 1000
            }
        }
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

    /**
     * Get Tokens
     *
     * @param  \Droplister\XcpCore\App\Events\OrderMatchWasCreated  $event
     * @return array
     */
    private function getTokens($event)
    {
        // Token One
        $token_one = Token::where('xcp_core_asset_name', '=', $event->order_match->backward_asset)->first();

        // Token Two
        $token_two = Token::where('xcp_core_asset_name', '=', $event->order_match->forward_asset)->first();

        // Tokens []
        if($token_one && $token_two)
        {
            // Both
            $tokens = [$token_one, $token_two];
        }
        else
        {
            // One
            $tokens = $token_one ? [$token_one] : [$token_two];
        }

        return $tokens;
    }
}