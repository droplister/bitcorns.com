<?php

/**
 * Convert 1 to 1st, etc...
 * https://stackoverflow.com/questions/3109978/display-numbers-with-ordinal-suffix-in-php
 *
 * @param  integer  $number
 * @return string
 */
function ordinal($number)
{
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13)) {
        return $number. 'th';
    } else {
        return $number. $ends[$number % 10];
    }
}

/**
 * Distance in Meters
 *
 * @param  float  $lat1
 * @param  float  $lon1
 * @param  float  $lat2
 * @param  float  $lon2
 * @return integer
 */
function distance($lat1, $lon1, $lat2, $lon2)
{
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);

    return $dist * 60 * 1.1515 * 1.609344 * 1000; // meters
}
