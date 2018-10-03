<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class Featured extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Featured";

    /*
     * A small description for the achievement
     */
    public $description = "Was featured on the homepage.";

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 1;
}
