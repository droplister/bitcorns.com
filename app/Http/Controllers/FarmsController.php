<?php

namespace App\Http\Controllers;

use Cache;
use App\Coop;
use App\Farm;
use Illuminate\Http\Request;
use App\Http\Requests\Farms\IndexRequest;
use App\Http\Requests\Farms\UpdateRequest;

class FarmsController extends Controller
{
    /**
     * List Farms (Sortable)
     *
     * @param  \App\Http\Requests\Farms\IndexRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        // Sort Order
        $sort = $request->has('q') ? 'search' : $request->input('sort', 'crops');

        // Cache Slug
        $cache_slug = 'farm_index_' . str_slug(serialize($request->all()) . $sort);

        // List Farms
        $farms = Cache::remember($cache_slug, 60, function () use ($request, $sort) {
            return Farm::getSortedFarms($request, $sort)->with('firstCrops')
                ->withCount('harvests')
                ->paginate(45);
        });

        // Index View
        return view('farms.index', compact('farms', 'sort'));
    }

    /**
     * Show Farm (Cached)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Farm $farm)
    {
        // Tokens: Access and Rewards
        $tokens = Cache::remember('farm_tokens_' . $farm->slug, 60, function () use ($farm) {
            return $farm->tokenBalances()->get();
        });

        // Tokens: Upgrades
        $upgrades = Cache::remember('farm_upgrades_' . $farm->slug, 60, function () use ($farm) {
            return $farm->upgradeBalances()->get();
        });

        // Uploads: Farm Art
        $uploads = Cache::remember('farm_uploads_' . $farm->slug, 60, function () use ($farm) {
            return $farm->uploads()->whereNull('rejected_at')->latest()->get();
        });

        // Show View
        return view('farms.show', compact('farm', 'tokens', 'upgrades', 'uploads'));
    }

    /**
     * Edit Farm
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Farm $farm)
    {
        // Dropdown
        $coops = Cache::remember('coops_abc', 60, function () {
            return Coop::has('farms')->orderBy('name', 'asc')->get();
        });

        return view('farms.edit', compact('farm', 'coops'));
    }

    /**
     * Update Farm
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

        // Update Farm
        $farm->updateFarm($request);

        // World Map
        Cache::forget('world_map');

        // Return Back
        return back()->with('success', 'Success - Update Complete!');
    }
}