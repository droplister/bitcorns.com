<?php

namespace App\Achievements\Farms;

use Gstt\Achievements\Achievement;

class MarketManipulation extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Market Manipulation";

    /*
     * A small description for the achievement
     */
    public $description = "Traded for 1,000,000 BITCORN on the Counterparty DEX.";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 1000000;
}
