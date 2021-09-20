<?php

namespace App\Achievements\Farms;

use Gstt\Achievements\Achievement;

class FarmersMarket extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Farmers Market";

    /*
     * A small description for the achievement
     */
    public $description = "This farm has more corn than they've harvested.";

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 1000;
}
