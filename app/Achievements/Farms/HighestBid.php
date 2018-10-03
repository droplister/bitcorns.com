<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class HighestBid extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Highest Bid";

    /*
     * A small description for the achievement
     */
    public $description = "Won an auction lot in a Bitcorn auction.";
}
