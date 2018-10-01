<?php

namespace App\Http\Controllers\Api;

use Cache;
use App\Coop;
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

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Coop  $coop
     * @return \Illuminate\Http\Response
     */
    public function show(Coop $coop)
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
