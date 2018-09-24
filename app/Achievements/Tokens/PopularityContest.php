<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class PopularityContest extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Popularity Contest";

    /*
     * A small description for the achievement
     */
    public $description = "1000 addresses own/have owned this card!";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 1000;
}