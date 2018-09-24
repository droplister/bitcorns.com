<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class HighFrequencyTrading extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "High Frequency Trading";

    /*
     * A small description for the achievement
     */
    public $description = "The bots are the captain now. Obey!";

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 1000;
}