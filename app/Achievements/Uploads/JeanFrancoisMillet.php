<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class JeanFrancoisMillet extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Jean-François Millet";

    /*
     * A small description for the achievement
     */
    public $description = "10 uploads! Very artsy.";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 10;
}
