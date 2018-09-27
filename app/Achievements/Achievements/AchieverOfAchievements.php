<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class AchieverOfAchievements extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Achiever of Achievements";

    /*
     * A small description for the achievement
     */
    public $description = "Achieved 10+ Achievements. Well done!";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 10;
}