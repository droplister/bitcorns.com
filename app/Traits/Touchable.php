<?php

namespace App\Traits;

use Carbon\Carbon;

trait Touchable
{
    /**
     * Touch Timestamp w/ Options
     * 
     * @param  string       $timestamp    timestamp to touch
     * @param  boolean      $override     overwrite non-null
     * @param  \Carbon|null $new_time     user-defined time     
     * @return false|\Illuminate\Database\Eloquent\Model
     */
    public function touchTime($timestamp, $override = false, $new_time = null)
    {
        if($override && $new_time)
        {
            $this->{$timestamp} = $new_time;
            return $this->save();
        }
        elseif($override || null === $this->{$timestamp})
        {
            $this->{$timestamp} = Carbon::now();
            return $this->save();
        }

        return false;
    }
}