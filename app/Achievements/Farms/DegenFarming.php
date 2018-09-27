<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class DegenFarming extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Degen Farming";

    /*
     * A small description for the achievement
     */
    public $description = "Sent 100,000 BITCORN.";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 100000;
}