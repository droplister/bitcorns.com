<?php

namespace App\Listeners;

use DB;
use Droplister\XcpCore\App\Block;
use Gstt\Achievements\Event\Unlocked;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RelativeAchievementTimestamps
{
    /**
     * Handle the event.
     *
     * @param  \Gstt\Achievements\Event\Unlocked  $event
     * @return void
     */
    public function handle(Unlocked $event)
    {
        // Get Block
        $block = Block::latest('block_index')->first();

        // Timestamp
        DB::table('achievement_progress')
            ->where('id', '=', $event->progress->id)
            ->update(['unlocked_at' => $block->confirmed_at]);
    }
}
