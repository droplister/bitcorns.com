<?php

namespace App\Listeners;

use App\Farm;
use App\Token;
use App\Achievements\HighClass;
use App\Achievements\HighestBid;
use App\Achievements\HeyBigSender;
use App\Achievements\CornVelocity;
use App\Achievements\DegenFarming;
use App\Achievements\JPMorganChase;
use App\Achievements\FarmerWarbucks;
use App\Achievements\SavingsAndLoan;
use App\Achievements\DemocracyInAction;
use Droplister\XcpCore\App\Debit;
use Droplister\XcpCore\App\Credit;
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
            // Pertinent
            $source = Farm::where('xcp_core_address', '=', $event->send->source)->first();
            $destination = Farm::where('xcp_core_address', '=', $event->send->destination)->first();
            $token = Token::where('xcp_core_asset_name', '=', $event->send->asset)->first();

            // Highest Bid
            if($this->isAuctionLot($event))
            {
                $destination->unlockIfLocked(new HighestBid());
            }

            // High Class
            if($this->isBuyingCrops($event))
            {
                $destination->unlockIfLocked(new HighClass());
            }

            // Democracy In Action
            if($this->isElectionVote($event))
            {
                $source->unlockIfLocked(new DemocracyInAction());
            }

            // Big Send Achievements
            if($this->isBitcornSend($event))
            {
                // Total Bitcorn Sent
                $total_sent = Debit::where('action', '=', 'send')
                    ->where('address', '=', $event->send->source)
                    ->where('asset', '=', config('bitcorn.reward_token'))
                    ->sum('quantity');

                // Total Bitcorn Received
                $total_received = Credit::where('action', '=', 'send')
                    ->where('address', '=', $event->send->destination)
                    ->where('asset', '=', config('bitcorn.reward_token'))
                    ->sum('quantity');

                // Progress (Total Sent)
                $source->setProgress(new HeyBigSender(), $total_sent); // 10,000
                $source->setProgress(new DegenFarming(), $total_sent); // 100,000
                $source->setProgress(new CornVelocity(), $total_sent); // 1,000,000

                // Progress (Total Received)
                $destination->setProgress(new SavingsAndLoan(), $total_received); // 10,000
                $destination->setProgress(new FarmerWarbucks(), $total_received); // 100,000
                $destination->setProgress(new JPMorganChase(), $total_received);  // 1,000,000
            }
        }
    }

    /**
     * Is Auction Lot
     * 
     * @param  \Droplister\XcpCore\App\Events\SendWasCreated  $event
     * @return boolean
     */
    private function isAuctionLot($event)
    {
        // Decode Memo
        $memo = hex2bin($event->send->memo);

        return $event->send->source === config('bitcorn.genesis_address') &&
            $memo === 'Auction';
    }

    /**
     * Is Bitcorn Send
     * 
     * @param  \Droplister\XcpCore\App\Events\SendWasCreated  $event
     * @return boolean
     */
    private function isBitcornSend($event)
    {
        return $event->send->asset === config('bitcorn.reward_token');
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
     * Is Election Vote
     * 
     * @param  \Droplister\XcpCore\App\Events\SendWasCreated  $event
     * @return boolean
     */
    private function isElectionVote($event)
    {
        // Decode Memo
        $memo = hex2bin($event->send->memo);

        return $event->send->destination === config('bitcorn.voting_address') &&
            preg_match('/E\d+C\d+/', $memo) !== 0;
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