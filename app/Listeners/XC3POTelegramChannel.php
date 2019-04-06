<?php

namespace App\Listeners;

use Telegram;
use Droplister\XcpCore\App\Events\MessageWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class XC3POTelegramChannel
{
    /**
     * Handle the event.
     *
     * @param  \Droplister\XcpCore\App\Events\MessageWasCreated  $event
     * @return void
     */
    public function handle(MessageWasCreated $event)
    {
        // For Convenience
        $command = $event->message->command;
        $category = $event->message->category;
        $bindings = $event->message->bindings;

        // Updates
        if ($command === 'update' && $category === 'order') {
            $message = "Database: Set status of order to [{$bindings['status']}]. (https://xchain.io/tx/{$bindings['tx_hash']})";
        }
        // Inserts
        elseif ($command === 'insert') {
            switch($category) {
                case 'dividends':
                    $message = "Dividend: {$bindings['source']} paid {$bindings['dividend_asset']} to holders of {$bindings['asset']}. (https://xchain.io/tx/{$bindings['tx_hash']}) [{$bindings['status']}]";
                case 'cancels':
                    $message = "Cancel: (https://xchain.io/txt/{$bindings['tx_hash']}) [{$bindings['status']}]";
                case 'sends':
                    $message = "Send: {$bindings['asset']} from {$bindings['source']} to {$bindings['destination']}. (https://xchain.io/tx/{$bindings['tx_hash']}) [{$bindings['status']}]";
                case 'btcpays':
                    $message = "BTC Payment: {$bindings['source']} paid {$bindings['destination']}. (https://xchain.io/txt/{$bindings['tx_hash']}) [{$bindings['status']}]";
                case 'issuances':
                    $message = $this->issuanceMessage($bindings);
                case 'orders':
                    $message = "Order: {$bindings['source']} ordered {$bindings['get_asset']} for {$bindings['give_asset']} within {$bindings['expiration']} blocks. (https://xchain.io/txt/{$bindings['tx_hash']}) [{$bindings['status']}]";
            }
        }

        if (isset($message) && config('xcp-core.indexing')) {
            return Telegram::sendMessage([
                'chat_id' => -1001283911290,
                'text' => $message,
                'parse_mode' => 'Markdown',
                'disable_notification' => true,
                'disable_web_page_preview' => true,
            ]);
        }
    }

    private function issuanceMessage($bindings) {
        if($bindings['transfer'] === true) {
            return "Issuance: {$bindings['asset']} transfered to {$bindings['issuer']}. (https://xchain.io/txt/{$bindings['tx_hash']}) [{$bindings['status']}]";
        } elseif($bindings['locked'] === true) {
            return "Issuance: {$bindings['asset']} was locked by {$bindings['issuer']}. (https://xchain.io/txt/{$bindings['tx_hash']}) [{$bindings['status']}]";
        } else {
            if(isset($bindings['asset_longname']) && ! empty($bindings['asset_longname'])) {
                return "Issuance: {$bindings['asset_longname']} was issued by {$bindings['issuer']}. (https://xchain.io/txt/{$bindings['tx_hash']}) [{$bindings['status']}]";
            } else {
                return "Issuance: {$bindings['asset']} was issued by {$bindings['issuer']}. (https://xchain.io/txt/{$bindings['tx_hash']}) [{$bindings['status']}]";
            }
        }
    }
}
