<?php

namespace App\Http\Controllers\Api;

use App\Token;
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
        if($card->approved_at || $card->rejected_at) {
            return 'Error';
        }

        // Approve Card
        if($request->decision === 'approve') {
            // Timestamp
            $card->touchTime('approved_at');

            // Announcement
            $this->announceAcceptance($card);
        } else {
            // Timestamp
            $card->touchTime('rejected_at');

            // Announcement
            $this->announceRejection($card);
        }

        return 'OK';
    }

    /**
     * Announce Acceptance
     *
     * @param  \App\Token  $card
     * @return void
     */
    private function announceAcceptance(Token $card)
    {
        $link = route('api.publish.card', ['card' => $card->slug]);
        $message = "The Bitcorn Foundation has accepted **{$card->name}**. Click: {$link} to publish.";

        SendMessage::dispatch($message, 'private');
    }

    /**
     * Announce Rejection
     *
     * @param  \App\Token  $card
     * @return void
     */
    private function announceRejection(Token $card)
    {
        $message = "The Bitcorn Foundation has decided against publishing **{$card->name}**. Thank you for your submission.";

        SendMessage::dispatch($message);
    }
}
