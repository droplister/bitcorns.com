<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class AndyWarhol extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Andy Warhol";

    /*
     * A small description for the achievement
     */
    public $description = "100 uploads! Like a factory over here.";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 100;
}