<?php

namespace App\Http\Controllers\Api;

use Cache;
use App\Coop;
use App\MapMarker;
use Illuminate\Http\Request;
use App\Http\Resources\MapMarkerResource;
use App\Http\Controllers\Controller;

class MapController extends Controller
{
    /**
     * World Map
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // World Map
        return Cache::remember('world_map', 60, function () {
            $map_markers = MapMarker::with('farm')->get();
            return MapMarkerResource::collection($map_markers);
        });
    }

    /**
     * Territory
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coop  $coop
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Coop $coop)
    {
        // Cache Slug
        $cache_slug = "world_map_{$coop->slug}";

        // World Map
        return Cache::remember($cache_slug, 60, function () use ($coop) {
            $map_markers = MapMarker::with('farm')->whereHas('farm', function ($farm) use ($coop) {
                return $farm->where('coop_id', '=', $coop->id);
            })->get();
            return MapMarkerResource::collection($map_markers);
        });
    }
}
