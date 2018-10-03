<?php

namespace App\Traits;

use App\Farm;
use App\Http\Requests\Farms\UpdateRequest;

trait Mappable
{
    /**
     * Validate Coordinates
     *
     * @param  \App\Http\Requests\Farms\UpdateRequest  $request
     * @param  \App\Farm  $farm
     */
    static function validateCoordinates(UpdateRequest $request, Farm $farm)
    {
        if ($this->isCoordinateRequest($request)) {
            // Configurable
            $unit = 6378100; // meters

            // Find Nearby Map Marker
            $nearby = static::selectRaw('*,
                ($unit * ACOS(COS(RADIANS($request->latitude))
                      * COS(RADIANS(latitude))
                      * COS(RADIANS($request->longitude) - RADIANS(longitude))
                      + SIN(RADIANS($request->latitude))
                      * SIN(RADIANS(latitude)))) AS distance')
                ->whereNotIn('farm_id', [$farm->id])
                ->orderBy('distance', 'asc')
                ->first();

            // Possible Conflict Found
            if ($nearby) {
                // Distance Between
                $between = distance($request->latitude, $request->longitude, $nearby->latitude, $nearby->longitude); // meters

                // Distance Required
                $required = $farm->map_radius + $nearby->farm->map_radius; // meters

                // Not Enough Space
                if ($between < $required) {
                    return 'No Tresspassing (' . $nearby->farm->name . ')';
                }
            }
        }

        return false;
    }

    /**
     * Is Coordinate Request
     *
     * @param  \App\Http\Requests\Farms\UpdateRequest  $request
     * @return boolean
     */
    private function isCoordinateRequest(UpdateRequest $request)
    {
        return $request->has('latitude') &&
               $request->has('longitude') &&
               $request->latitude !== null &&
               $request->longitude !== null;
    }
}
