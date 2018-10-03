<?php

namespace App\Http\Controllers;

use Cache;
use App\Coop;
use App\Harvest;
use Illuminate\Http\Request;

class HarvestsController extends Controller
{
    /**
     * Harvest Schedule
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Harvests
        $harvests = Cache::remember('harvests_index', 60, function () {
            return Harvest::oldest('scheduled_at')->get();
        });

        // Index View
        return view('harvests.index', compact('harvests'));
    }

    /**
     * Specific Harvest
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Harvest  $harvest
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Harvest $harvest)
    {
        // The Coops
        $coops = Cache::remember('harvest_coops_' . $harvest->id, 1440, function () use ($harvest) {
            $unsorted = Coop::whereHas('harvests', function ($h) use ($harvest) {
                return $h->where('id', '=', $harvest->id);
            })->get();

            // Sorted
            return $unsorted->sortByDesc(function ($c) use ($harvest) {
                return $c->harvestTotal($harvest, true);
            });
        });

        // The Farms
        $farms = Cache::remember('harvest_farms_' . $harvest->id, 1440, function () use ($harvest) {
            $unsorted = $harvest->farms()->orderBy('quantity', 'desc')->get();

            // Sorted
            return $unsorted->sortByDesc(function ($f) {
                return $f->pivot->quantity * $f->pivot->multiplier;
            });
        });

        // Show View
        return view('harvests.show', compact('harvest', 'coops', 'farms'));
    }
}
