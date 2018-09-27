<?php

namespace App\Listeners;

use App\Achievements\AndyWarhol;
use App\Achievements\ArtsAndCrafts;
use App\Achievements\JeanFrancoisMillet;
use App\Events\UploadWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UploadAchievements
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\UploadWasCreated  $event
     * @return void
     */
    public function handle(UploadWasCreated $event)
    {
        // Morph
        $model = $event->upload->uploadable;

        // Count
        $count = $model->uploads()->count();

        // Progress (Uploads Count)
        $model->setProgress(new ArtsAndCrafts(), $count);      // 1
        $model->setProgress(new JeanFrancoisMillet(), $count); // 10
        $model->setProgress(new AndyWarhol(), $count);         // 100
    }
}