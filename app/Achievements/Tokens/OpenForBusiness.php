<?php

namespace App\Achievements\Tokens;

use Gstt\Achievements\Achievement;

class OpenForBusiness extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Open For Business";

    /*
     * A small description for the achievement
     */
    public $description = "First trade on the Counterparty DEX!";

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 1;
}