<?php

namespace App\Achievements\Farms;

use Gstt\Achievements\Achievement;

class BattleTested extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Battle Tested";

    /*
     * A small description for the achievement
     */
    public $description = "I remember my first battle. A win is a win!";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 1;
}
