<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class PonyExpress extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Pony Express";

    /*
     * A small description for the achievement
     */
    public $description = "My, my how this network has grown.";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 10;
}