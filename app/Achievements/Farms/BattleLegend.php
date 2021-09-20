<?php

namespace App\Achievements\Farms;

use Gstt\Achievements\Achievement;

class BattleLegend extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Battle Legend";

    /*
     * A small description for the achievement
     */
    public $description = "Simply a legend. Take a bow!";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 9001;
}
