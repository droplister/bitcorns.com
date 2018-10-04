<?php

namespace App\Http\Controllers;

use Cache;
use App\Farm;
use App\Token;
use App\Upload;
use App\MapMarker;
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
        $cache_slug = str_slug(serialize($request->all()) . $sort);

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
        return view('farms.edit', compact('farm'));
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

        // Return Back
        return back()->with('success', 'Success - Update Complete!');
    }
}