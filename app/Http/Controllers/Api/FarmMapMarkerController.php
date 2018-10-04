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
            return back()->with('error', $error);
        }

        // Validate Map
        if ($error = MapMarker::validateCoordinates($request, $farm)) {
            return back()->with('error', $error);
        }

        if($farm->mapMarker->exists())
        {
            return $farm->mapMarker->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        }
        else
        {
            return MapMarker::create([
                'farm_id' => $farm->id,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'settings' => [
                    'options' => [
                        'editable' => false,
                        'strokeColor' => '#000000',
                        'fillColor' => '#FFFFFF',
                    ]
                ],
                'major' => 1,
            ]);
        }

        Cache::forget('world_map');
    }
}
