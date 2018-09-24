<?php

namespace App\Achievements\Farms;

use Gstt\Achievements\Achievement;

class BattleHardened extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Battle Hardened";

    /*
     * A small description for the achievement
     */
    public $description = "Can you feel the momentum building? You could be a champion!";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 100;
}