<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class Famous extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Famous";

    /*
     * A small description for the achievement
     */
    public $description = "Was featured 10+ times.";

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 10;
}