<?php

namespace App\Jobs;

use App\Farm;
use App\Achievements\Farms\BattleLegend;
use App\Achievements\Farms\BattleTested;
use App\Achievements\Farms\BattleChampion;
use App\Achievements\Farms\BattleHardened;
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
        foreach ($farms as $farm) {
            // Bitcorn Battle API
            $total = $farm->getBattleStat('wins');

            // Progress (Total Wins)
            $farm->setProgress(new BattleTested(), $total);   // 1
            $farm->setProgress(new BattleHardened(), $total); // 100
            $farm->setProgress(new BattleChampion(), $total); // 1000
            $farm->setProgress(new BattleLegend(), $total);   // 9001
        }
    }
}
