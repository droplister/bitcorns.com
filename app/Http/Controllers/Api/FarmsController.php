<?php

namespace App\Http\Controllers\Api;

use App\Farm;
use App\Http\Resources\FarmCollection;
use App\Http\Resources\FarmResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FarmsController extends Controller
{
    /**
     * List Farms
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $farms = Farm::with('coop')->withCount('upgradeBalances')->get();

        return FarmCollection::collection($farms);
    }

    /**
     * Show Farm
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Farm $farm
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Farm $farm)
    {
        return new FarmResource($farm);
    }
}
