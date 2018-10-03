<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class BattleChampion extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Battle Champion";

    /*
     * A small description for the achievement
     */
    public $description = "Other farms tremble at the mere mention of your name.";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 1000;
}
