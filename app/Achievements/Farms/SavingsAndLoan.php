<?php

namespace App\Achievements\Farms;

use Gstt\Achievements\Achievement;

class SavingsAndLoan extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Savings & Loan";

    /*
     * A small description for the achievement
     */
    public $description = "Received 10,000 BITCORN.";
    
    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 10000;
}
