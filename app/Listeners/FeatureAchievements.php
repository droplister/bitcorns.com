<?php

namespace App\Listeners;

use App\Farm;
use App\Achievements\Famous;
use App\Achievements\Featured;
use App\Achievements\Publicist;
use App\Events\FeatureWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FeatureAchievements
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\FeatureWasCreated  $event
     * @return void
     */
    public function handle(FeatureWasCreated $event)
    {
        // Publicist
        if ($farm = Farm::findBySlug($event->feature->address)) {
            $farm->unlockIfLocked(new Publicist());
        }

        // Farm/Coop/Token
        $model = $event->feature->featurable;
        $count = $model->features()->count();

        // Progress (Feature Count)
        $model->setProgress(new Featured(), $count); // 1
        $model->setProgress(new Famous(), $count);   // 10
    }
}
