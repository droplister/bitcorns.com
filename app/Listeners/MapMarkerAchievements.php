<?php

namespace App\Listeners;

use App\Achievements\WereOnTheMap;
use App\Events\MapMarkerWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MapMarkerAchievements
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\MapMarkerWasCreated  $event
     * @return void
     */
    public function handle(MapMarkerWasCreated $event)
    {
        $event->map_marker->farm->unlockIfLocked(new WereOnTheMap());
    }
}
