<?php

namespace App\Traits;

use Gstt\Achievements\Achievement;

trait Achievable
{
    /**
     * Unlock If Locked
     * 
     * @param Achievement $achievement
     * @return void
     */
    public function unlockIfLocked(Achievement $achievement)
    {
        if(! $this->hasUnlocked($achievement))
        {
            $this->unlock($achievement);
        }
    }
}