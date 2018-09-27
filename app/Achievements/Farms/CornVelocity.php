<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class CornVelocity extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Corn Velocity";

    /*
     * A small description for the achievement
     */
    public $description = "Sent 1,000,000 BITCORN.";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 1000000;
}