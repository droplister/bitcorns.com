<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class TechnicalAnalysis extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Technical Analysis";

    /*
     * A small description for the achievement
     */
    public $description = "A doji on the 9 is a buy signal.";

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 9;
}
