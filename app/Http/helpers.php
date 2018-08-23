<?php

/**
 * Convery 1 to 1st, etc...
 * https://stackoverflow.com/questions/3109978/display-numbers-with-ordinal-suffix-in-php
 * 
 * @param  integer  $number
 * @return string
 */
function ordinal($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        return $number. 'th';
    else
        return $number. $ends[$number % 10];
}