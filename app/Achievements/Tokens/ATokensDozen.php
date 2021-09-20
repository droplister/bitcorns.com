<?php

namespace App\Achievements\Tokens;

use Gstt\Achievements\Achievement;

class ATokensDozen extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "A Token's Dozen";

    /*
     * A small description for the achievement
     */
    public $description = "More than a few, less than a lot, keep going!";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 13;
}
