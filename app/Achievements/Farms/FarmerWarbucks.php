<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class FarmerWarbucks extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Farmer Warbucks";

    /*
     * A small description for the achievement
     */
    public $description = "Received 100,000 BITCORN.";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 100000;
}
