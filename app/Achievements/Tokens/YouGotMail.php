<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class YouGotMail extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "You Got Mail";

    /*
     * A small description for the achievement
     */
    public $description = "First send on the Bitcoin blockchain.";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 1;
}
