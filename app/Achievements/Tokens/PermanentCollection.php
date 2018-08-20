<?php

namespace App\Achievements\Tokens;

use Gstt\Achievements\Achievement;

class PermanentCollection extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Permanent Collection";

    /*
     * A small description for the achievement
     */
    public $description = "This token is now permanently on display at the Bitcorn Museum.";
}