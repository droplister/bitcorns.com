<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class JPMorganChase extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "JPMorgan Chase";

    /*
     * A small description for the achievement
     */
    public $description = "Received 1,000,000 BITCORN.";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 1000000;
}
