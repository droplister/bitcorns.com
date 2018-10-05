<?php

namespace App\Listeners;

use App\Farm;
use App\Token;
use JsonRPC\Client;
use App\Jobs\SendMessage;
use App\Events\TokenWasCreated;
use Droplister\XcpCore\App\Address;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AnnounceNewCardSubmissions
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\TokenWasCreated  $event
     * @return void
     */
    public function handle(TokenWasCreated $event)
    {
        // Upgrades Only
        if ($this->isUpgradeToken($event)) {
            // Check Museum
            $this->checkMuseumDonations($event->token);

            // Submissions Only
            if ($this->isSubmission($event)) {
                // Tell Farmers
                $this->publicAnnouncement($event->token);

                // & Foundation
                $this->privateAnnouncement($event->token);
            }
        }
    }

    /**
     * Check Museum Donations
     *
     * @param  \App\Token  $token
     * @return void
     */
    private function checkMuseumDonations($token)
    {
        // If submitted after burning, regular listener will miss it,
        // so this is just a check to be sure its not missed.
        $museum = Farm::findBySlug(config('bitcorn.museum_address'));

        if ($museum && $museum->hasBalance($token->xcp_core_asset_name)) {
            $token->touchTime('museumed_at');
        } else {
            // Only used by the UpgradeTokensTableSeeder
            $balances = $this->getMuseumBalances($token);

            if (! empty($balances)) {
                $token->touchTime('museumed_at');
            }
        }
    }

    /**
     * Public Announcement
     *
     * @param  \App\Token  $token
     * @return void
     */
    private function publicAnnouncement($token)
    {
        $depth = ordinal(Token::pending()->upgrades()->count());
        $message = "{$token->name} was submitted. {$depth} in queue.";

        SendMessage::dispatch($message, 'public');
    }

    /**
     * Private Announcement
     *
     * @param  \App\Token  $token
     * @return void
     */
    private function privateAnnouncement($token)
    {
        $locked = $token->asset->locked ? 'True' : 'False';
        $divisible = $token->asset->divisible ? 'True' : 'False';
        $issuance = number_format($token->asset->issuance_normalized);
        $museumed_at = $token->museumed_at ? $token->museumed_at : 'Pending';
        $preview = route('cards.show', ['card' => $token->slug, 'preview' => 'true']);

        $message = "*{$token->name}*\n";
        $message.= "{$preview}\n";
        $message.= "Issued: {$issuance}\n";
        
        if (Token::publishable()->where('id', '=', $token->id)->exists()) {
            $message.= "Publishable submission!";
        } else {
            $message.= "Not okay to publish yet...\n";
            $message.= "- Locked: {$locked}\n";
            $message.= "- Divisible: {$divisible}\n";
            $message.= "- Museumed: {$museumed_at}\n";
        }

        SendMessage::dispatch($message, 'private');
    }

    /**
     * Is Upgrade Token
     *
     * @param  \App\Events\TokenWasCreated  $event
     * @return boolean
     */
    private function isUpgradeToken($event)
    {
        return $event->token->type === 'upgrade';
    }

    /**
     * Is Submission
     *
     * @param  \App\Events\TokenWasCreated  $event
     * @return boolean
     */
    private function isSubmission($event)
    {
        return $event->token->harvest_id === null;
    }

    /**
     * Counterparty API
     * https://counterparty.io/docs/api/#get_table
     *
     * @param  \App\Token  $token
     * @return mixed
     */
    private function getMuseumBalances($token)
    {
        $counterparty = new Client(config('xcp-core.cp.api'));
        $counterparty->authentication(config('xcp-core.cp.user'), config('xcp-core.cp.password'));

        // Useful when seeding (not locally synced)
        return $counterparty->execute('get_balances', [
            'filters' => [
                [
                    'field' => 'address',
                    'op' => '==',
                    'value' => config('bitcorn.museum_address'),
                ],[
                    'field' => 'asset',
                    'op'    => '==',
                    'value' => $token->xcp_core_asset_name,
                ]
            ]
        ]);
    }
}
