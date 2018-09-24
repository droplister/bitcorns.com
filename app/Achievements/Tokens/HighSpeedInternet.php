<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class HighSpeedInternet extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "High Speed Internet";

    /*
     * A small description for the achievement
     */
    public $description = "You say SPAM. I say blockchain use-case.";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 1000;
}