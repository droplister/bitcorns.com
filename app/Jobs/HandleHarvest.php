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
     * Harvest
     *
     * @var \App\Harvest
     */
    protected $harvest;

    /**
     * Create a new job instance.
     *
     * @param  \Droplister\XcpCore\App\Dividend  $dividend
     * @return void
     */
    public function __construct(Dividend $dividend)
    {
        $this->dividend = $dividend;
        $this->harvest = Harvest::upcoming()->first();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Handle The Credits
        $this->handleCredits();

        // Update Harvest TX
        $this->updateHarvest();

        // Fire Harvest Event
    }

    /**
     * Handle Credits
     * 
     * @return void
     */
    private function handleCredits()
    {
        $credits = $this->getCredits();

        foreach($credits as $credit)
        {
            $this->createFarmHarvest($credit);
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
     * @param  \Droplister\XcpCore\App\Credit  $credit
     * @return mixed
     */
    private function createFarmHarvest($credit)
    {
        $farm = Farm::findBySlug($credit->address);

        return $farm->harvests()->syncWithoutDetaching([
            $this->harvest->id => [
                'coop_id' => $farm->coop_id,
                'quantity' => $credit->quantity,
                'dryasabone' => $farm->isDAAB(),
            ]
        ]);
    }

    /**
     * Update Harvest
     * 
     * @return \App\Harvest
     */
    private function updateHarvest()
    {
        return $this->harvest->update([
            'xcp_core_tx_index' => $this->dividend->tx_index,
        ]);
    }
}