<?php

namespace App\Http\Controllers\Api;

use App\Token;
use App\Harvest;
use App\Jobs\SendMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApprovalController extends Controller
{
    /**
     * Approve/Deny
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Token  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Token $card)
    {
        // Validation
        $request->validate([
            'decision' => 'required|in:approve,deny',
        ]);

        // Simple Guard
        if ($card->approved_at || $card->rejected_at) {
            return 'Error';
        }

        // Approve Card
        if ($request->decision === 'approve') {
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
                'meta_data' => [
                    'harvest_ranking' => $harvest_ranking,
                    'overall_ranking' => $overall_ranking,
                ],
            ]);

            // Timestamp
            $card->touchTime('approved_at');
            $card->touchTime('published_at');
        } else {
            // Timestamp
            $card->touchTime('rejected_at');
        }

        return 'OK';
    }
}
