<?php

namespace App\Achievements\Tokens;

use Gstt\Achievements\Achievement;

class GenerousBenefactor extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Generous Benefactor";

    /*
     * A small description for the achievement
     */
    public $description = "A generous benefactor donated more than 1 token to our Museum.";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 2;
}