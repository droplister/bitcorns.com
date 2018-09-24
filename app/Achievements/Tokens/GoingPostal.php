<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class GoingPostal extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Going Postal";

    /*
     * A small description for the achievement
     */
    public $description = "Look out! This card's gone postal!";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 100;
}