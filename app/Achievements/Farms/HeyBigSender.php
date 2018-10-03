<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class HeyBigSender extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Hey Big Sender";

    /*
     * A small description for the achievement
     */
    public $description = "Sent 10,000 BITCORN.";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 10000;
}
