<?php

namespace App\Achievements\Tokens;

use Gstt\Achievements\Achievement;

class MyFirstHodler extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "My First Hodler";

    /*
     * A small description for the achievement
     */
    public $description = "You got your first hodler, worth framing this one!";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 1;
}
