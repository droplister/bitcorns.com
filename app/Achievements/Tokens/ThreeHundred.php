<?php

namespace App\Achievements\Tokens;

use Gstt\Achievements\Achievement;

class ThreeHundred extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "300";

    /*
     * A small description for the achievement
     */
    public $description = "THIS! IS! BITCORN!";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 300;
}