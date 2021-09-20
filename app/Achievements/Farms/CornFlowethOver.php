<?php

namespace App\Achievements\Farms;

use Gstt\Achievements\Achievement;

class CornFlowethOver extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Corn Floweth Over";

    /*
     * A small description for the achievement
     */
    public $description = "Over 100,000 BITCORN gotten from means other than harvesting.";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 100000;
}
