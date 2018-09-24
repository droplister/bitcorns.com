<?php

namespace App\Achievements\Tokens;

use Gstt\Achievements\Achievement;

class MerchantAdoption extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Merchant Adoption";

    /*
     * A small description for the achievement
     */
    public $description = "100 trades on the DEX is basically mainstream.";

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 100;
}