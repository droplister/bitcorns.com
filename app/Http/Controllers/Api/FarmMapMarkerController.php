<?php

namespace App\Http\Controllers\Api;

use Cache;
use App\Farm;
use App\MapMarker;
use Illuminate\Http\Request;
use App\Http\Requests\Farms\UpdateRequest;
use App\Http\Controllers\Controller;

class FarmMapMarkerController extends Controller
{
    /**
     * Update Map Marker
     *
     * @param  \App\Http\Requests\Farms\UpdateRequest  $request
     * @param  \App\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Farm $farm)
    {
        // Authenticate
        if ($error = $farm->validateSignature($request)) {
            return $error;
        }

        // Validate Map
        if ($error = MapMarker::validateCoordinates($request, $farm)) {
            return $error;
        }

        // Update Marker
        $farm->updateMapMarker($request->latitude, $request->longitude);

        // Okie Doke
        return 'ok';
    }
}
