<?php

namespace App\Achievements\Farms;

use Gstt\Achievements\Achievement;

class Cornucopia extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Cornucopia";

    /*
     * A small description for the achievement
     */
    public $description = "Over 10,000 BITCORN gotten from means other than harvesting.";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 10000;
}
