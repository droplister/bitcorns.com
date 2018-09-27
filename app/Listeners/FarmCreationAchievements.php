<?php

namespace App\Listeners;

use App\Achievements\EarlyAcropter;
use App\Events\FarmWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FarmCreationAchievements
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\FarmWasCreated  $event
     * @return void
     */
    public function handle(FarmWasCreated $event)
    {
        if($event->farm->firstCrops->block_index < config('bitcorn.ico_block_index'))
        {
            $event->farm->unlockIfLocked(new EarlyAcropter());
        }
    }
}
