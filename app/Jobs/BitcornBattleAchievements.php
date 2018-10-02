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
            $data = $farm->getBattleStats();

            // Simple Guard
            if(isset($data['wins']))
            {
                // Win Count
                $won = (int) $data['wins'];

                // Progress (Battles Won)
                $farm->setProgress(new BattleTested(), $won);   // 1
                $farm->setProgress(new BattleHardened(), $won); // 100
                $farm->setProgress(new BattleChampion(), $won); // 1000
                $farm->setProgress(new BattleLegend(), $won);   // 9001
            }
        }
    }
}