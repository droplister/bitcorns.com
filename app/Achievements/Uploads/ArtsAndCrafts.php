<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class ArtsAndCrafts extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Arts & Crafts";

    /*
     * A small description for the achievement
     */
    public $description = "1 upload! So creative.";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 1;
}