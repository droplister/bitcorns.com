<?php

namespace App\Jobs;

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

        // Update Harvest TX
        $this->updateHarvest($harvest);

        // Fire Harvest Event
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

        foreach($credits as $credit)
        {
            $this->createFarmHarvest($harvest, $credit);
        }
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
     * Create Farm Harvest
     *
     * @param  \App\Harvest  $harvest
     * @param  \Droplister\XcpCore\App\Credit  $credit
     * @return mixed
     */
    private function createFarmHarvest($harvest, $credit)
    {
        $farm = Farm::findBySlug($credit->address);

        // Report DAAB

        return $farm->harvests()->syncWithoutDetaching([
            $harvest->id => [
                'coop_id' => $farm->coop_id,
                'quantity' => $farm->isDAAB() ? 0 : $credit->quantity,
            ]
        ]);
    }

    /**
     * Update Harvest
     * 
     * @return \App\Harvest
     */
    private function updateHarvest($harvest)
    {
        return $harvest->update([
            'xcp_core_tx_index' => $this->dividend->tx_index,
        ]);
    }
}