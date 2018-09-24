<?php

namespace App\Jobs;

use App\Farm;
use App\Achievements\BattleTested;
use App\Achievements\BattleHardened;
use App\Achievements\BattleChampion;
use App\Achievements\BattleLegend;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class BitcornBattleAchievements implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Bitcorn Farms
        $farms = Farm::get();

        // Check 'Em All
        foreach($farms as $farm)
        {
            // Battle API
            $stats = $this->getStats($farm->xcp_core_address);

            // Simple Guard
            if(isset($data['wins']))
            {
                // Win Count
                $won = (int) $data['wins'];

                // Progress (Battles Won)
                $farm->setProgress(BattleTested, $won);   // 1
                $farm->setProgress(BattleHardened, $won); // 100
                $farm->setProgress(BattleChampion, $won); // 1000
                $farm->setProgress(BattleLegend, $won);   // 9001
            }
        }
    }

    /**
     * Get Stats
     * 
     * @param  string $address
     * @return array
     */
    private function getStats($address)
    {
        $data = file_get_contents('http://bitcornbattle.com/api/winloss.php?a=' . $address);

        return json_decode($data, true);
    }
}