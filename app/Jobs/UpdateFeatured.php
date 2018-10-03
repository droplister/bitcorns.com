<?php

namespace App\Jobs;

use App\Coop;
use App\Farm;
use App\Token;
use App\Feature;
use Droplister\XcpCore\App\Send;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateFeatured implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Block Index
     *
     * @var integer
     */
    protected $block_index;

    /**
     * Create a new job instance.
     *
     * @param  \App\Cause  $cause
     * @return void
     */
    public function __construct($block_index)
    {
        $this->block_index = $block_index;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // API Data
        $sends = $this->getSends();

        foreach ($sends as $send) {
            // Decode Memo
            $memo = trim(hex2bin($send->memo));

            // New Feature
            $feature = Feature::firstOrNew([
                'xcp_core_tx_index' => $send->tx_index,
            ], [
                'address' => $send->source,
                'bid' => $send->quantity,
            ]);

            // Card Feature
            if ($card = Token::upgrades()->where('name', '=', $memo)->first()) {
                $card->features()->save($feature);
            } // Coop Feature
            elseif ($coop = Coop::findBySlug($memo)) {
                $coop->features()->save($feature);
            } // Farm Feature
            elseif ($farm = Farm::findBySlug($memo)) {
                $farm->features()->save($feature);
            }
        }
    }

    /**
     * Get Sends
     *
     * @return mixed
     */
    private function getSends()
    {
        return Send::where('asset', '=', config('bitcorn.reward_token'))
            ->where('destination', '=', config('bitcorn.feature_address'))
            ->where('status', '=', 'valid')
            ->where('block_index', '<=', $this->block_index - 2)
            ->get();
    }
}
