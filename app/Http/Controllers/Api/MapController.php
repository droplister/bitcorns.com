<?php

namespace App\Http\Controllers\Api;

use Cache;
use App\MapMarker;
use App\Http\Resources\MapMarkerResource;
use App\Http\Controllers\Controller;

class MapController extends Controller
{
    /**
     * World Map
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // World Map
        return Cache::remember('world_map', 60, function () {
            $map_markers = MapMarker::with('farm')->get();
            return MapMarkerResource::collection($map_markers);
        });
    }
}
