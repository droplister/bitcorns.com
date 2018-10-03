<?php

namespace App\Listeners;

use App\Achievements\AchieverOfAchievements;
use Gstt\Achievements\Event\Unlocked;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AchievementAchievements
{
    /**
     * Handle the event.
     *
     * @param  \Gstt\Achievements\Event\Unlocked  $event
     * @return void
     */
    public function handle(Unlocked $event)
    {
        // Count
        $count = $event->progress->achiever->achievements()->whereNotNull('unlocked_at')->count();

        // Progress
        $event->progress->achiever->setProgress(new AchieverOfAchievements(), $count); // 10
    }
}
