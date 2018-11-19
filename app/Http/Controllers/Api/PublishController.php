<?php

namespace App\Http\Controllers\Api;

use App\Token;
use App\Harvest;
use App\Jobs\SendMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublishController extends Controller
{
    /**
     * Publish Card
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Token  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Token $card)
    {
        // Simple Guard
        if(! $card->approved_at || $card->rejected_at) {
            return 'Error';
        }

        // Harvest
        $harvest = Harvest::current()->first();

        // Harvest #
        $harvest_ranking = Token::where('harvest_id', '=', $harvest->id)
            ->upgrades()
            ->published()
            ->count() + 1;

        // Overall #
        $overall_ranking = Token::upgrades()
            ->published()
            ->count() + 1;

        // Card Data
        $card->update([
            'harvest_id' => $harvest->id,
            'meta_data->harvest_ranking' => $harvest_ranking,
            'meta_data->overall_ranking' => $overall_ranking,
        ]);

        // Timestamp
        $card->touchTime('published_at');

        // Announcement
        $this->announcePublication($card);

        return 'OK';
    }

    /**
     * Announce Publication
     *
     * @param  \App\Token  $card
     * @return void
     */
    private function announcePublication(Token $card)
    {
        $message = "**Introducing {$card->name}**\n";
        $message.= "Issued: {$card->asset->supply_normalized}\n";
        $message.= route('cards.show', ['card' => $card->slug]);

        SendMessage::dispatch($message, 'public');
    }
}