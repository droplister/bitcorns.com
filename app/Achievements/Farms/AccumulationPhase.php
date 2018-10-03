<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class AccumulationPhase extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Accumulation Phase";

    /*
     * A small description for the achievement
     */
    public $description = "Traded for 100,000 BITCORN on the Counterparty DEX.";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 100000;
}
