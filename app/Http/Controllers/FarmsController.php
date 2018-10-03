<?php

namespace App\Http\Controllers;

use Auth;
use Cache;
use App\Farm;
use App\Token;
use App\Upload;
use App\MapMarker;
use App\Http\Requests\Farms\IndexRequest;
use App\Http\Requests\Farms\UpdateRequest;
use Illuminate\Http\Request;

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

        // List Farms
        $farms = Farm::getSortedFarms($request, $sort)->with('firstCrops')
            ->withCount('harvests')
            ->paginate(45);

        // Index View
        return view('farms.index', compact('farms', 'sort'));
    }

    /**
     * Show Farm
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Farm $farm)
    {
        // Tokens: Access and Rewards
        $tokens = $farm->tokenBalances()->get();

        // Tokens: Upgrades
        $upgrades = $farm->upgradeBalances()->get();

        // Show View
        return view('farms.show', compact('farm', 'tokens', 'upgrades'));
    }

    /**
     * Edit Farm
     *
     * @param  \App\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function edit(Farm $farm)
    {
        return view('farms.edit', compact('farm'));
    }

    /**
     * Update Player
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

        // Update Farm
        $farm->updateFarm($request);

        // Return Back
        return back()->with('success', 'Success - Update Complete!');
    }
}
