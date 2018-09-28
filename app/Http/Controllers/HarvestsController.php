<?php

namespace App\Http\Controllers;

use App\Coop;
use App\Harvest;
use Illuminate\Http\Request;

class HarvestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Harvest Schedule
        $harvests = Harvest::oldest('scheduled_at')->get();

        // Index View
        return view('harvests.index', compact('harvests'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Harvest  $harvest
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Harvest $harvest)
    {
        // The Coops
        $coops = Coop::whereHas('harvests', function ($h) use ($harvest) {
            return $h->where('id', '=', $harvest->id);
        })->get();

        // Sort By
        $coops = $coops->sortByDesc(function ($coop) use ($harvest)  {
            return $coop->harvestTotal($harvest, true);
        });

        // The Farms
        $farms = $harvest->farms()->orderBy('quantity', 'desc')->get();

        // Show View
        return view('harvests.show', compact('harvest', 'coops', 'farms'));
    }
}