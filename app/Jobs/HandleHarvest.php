<?php

namespace App\Jobs;

use App\Coop;
use App\Farm;
use App\Harvest;
use Droplister\XcpCore\App\Credit;
use Droplister\XcpCore\App\Dividend;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class HandleHarvest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Dividend
     *
     * @var \Droplister\XcpCore\App\Dividend
     */
    protected $dividend;

    /**
     * Create a new job instance.
     *
     * @param  \Droplister\XcpCore\App\Dividend  $dividend
     * @return void
     */
    public function __construct(Dividend $dividend)
    {
        $this->dividend = $dividend;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Next Harvest (this)
        $harvest = Harvest::upcoming()->first();

        // Handle The Credits
        $this->handleCredits($harvest);

        // Update Genesis Farm
        $this->updateGenesis($harvest);

        // Update Coop Totals
        $this->updateTotalHarvested();

        // Update Harvest TX
        $this->updateHarvest($harvest);

        // Fire Harvest Event
    }

    /**
     * Get Credits
     *
     * @return \Droplister\XcpCore\App\Credit
     */
    private function getCredits()
    {
        return Credit::where('event', '=', $this->dividend->tx_hash)
            ->selectRaw('SUM(quantity) as quantity, address')
            ->where('quantity', '>', 0)
            ->groupBy('address')
            ->get();
    }

    /**
     * Handle Credits
     *
     * @param  \App\Harvest  $harvest
     * @return void
     */
    private function handleCredits($harvest)
    {
        $credits = $this->getCredits();

        foreach ($credits as $credit) {
            $this->createFarmHarvest($harvest, $credit);
        }
    }

    /**
     * Create Farm Harvest
     *
     * @param  \App\Harvest  $harvest
     * @param  \Droplister\XcpCore\App\Credit  $credit
     * @return mixed
     */
    private function createFarmHarvest($harvest, $credit)
    {
        // Get The Farm
        $farm = Farm::findBySlug($credit->address);

        // Sync Harvest
        $this->syncFarmHarvest($farm, $harvest, $credit->quantity);
    }

    /**
     * Create Farm Harvest
     *
     * @param  \App\Harvest  $harvest
     * @return mixed
     */
    private function updateGenesis($harvest)
    {
        // Genesis Farm
        $farm = Farm::findBySlug(config('bitcorn.genesis_address'));

        // Calc Quantity
        $quantity = $harvest->quantity - $harvest->farms()->sum('quantity');

        // Sync Harvest
        $this->syncFarmHarvest($farm, $harvest, $quantity);
    }

    /**
     * Update Harvest
     *
     * @param  \App\Harvest  $harvest
     * @return \App\Harvest
     */
    private function updateHarvest($harvest)
    {
        return $harvest->update([
            'xcp_core_tx_index' => $this->dividend->tx_index,
        ]);
    }

    /**
     * Sync Farm Harvest
     *
     * @param  \App\Farm  $farm
     * @param  \App\Harvest  $harvest
     * @param  integer  $quantity
     * @return \App\Farm
     */
    private function syncFarmHarvest($farm, $harvest, $quantity)
    {
        // Multiplier
        $multiplier = $this->getMultiplier($farm, $harvest);

        // Update Total
        $farm->update(['total_harvested' => $farm->total_harvested + $quantity]);

        // Sync Harvest
        return $farm->harvests()->syncWithoutDetaching([
            $harvest->id => [
                'coop_id' => $farm->coop_id,
                'quantity' => $quantity,
                'multiplier' => $multiplier,
            ]
        ]);
    }

    /**
     * Update Total Harvested
     *
     * @return void
     */
    private function updateTotalHarvested()
    {
        // All Coops
        $coops = Coop::get();

        // Calc Totals
        foreach ($coops as $coop) {
            // All Time (with multiplier taken into consideration)
            $total_harvested = $coop->harvests->sum(function ($harvest) {
                return $harvest->pivot->quantity * $harvest->pivot->multiplier;
            });

            // Update Total
            $coop->update(['total_harvested' => $total_harvested]);
        }
    }

    /**
     * Get Multiplier
     *
     * @param  \App\Farm  $farm
     * @param  \App\Harvest  $harvest
     * @return float
     */
    private function getMultiplier($farm, $harvest)
    {
        // Default
        $multiplier = 1;

        // Harvest 2-16
        if ($harvest->id > 1 && $farm->isDAAB()) {
            // Dry As A Bone
            $multiplier = $multiplier * 0;
        }

        // Harvest 3-16
        if ($harvest->id > 2 && $farm->coop && $farm->coop->isAC()) {
            // Alpha Collectors
            $multiplier = $multiplier * 1.5;
        }

        // Harvest 4-16
        if ($harvest->id > 3 && $farm->isCP()) {
            // Corn Prayer
            $multiplier = $multiplier * 2;
        }

        // 0.0/1.0/1.5/2.0/3.0
        return $multiplier;
    }
}
