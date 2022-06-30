<?php

namespace App\Http\Controllers;

use Cache;
use App\Farm;
use App\Http\Requests\Fair\StoreRequest;
use Illuminate\Http\Request;

class FairController extends Controller
{
    /**
     * Find Fair
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Index View
        return view('fair.index');
    }

    /**
     * Show Fair
     *
     * @param  \App\Http\Requests\Fair\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        // Farms
        $farm_1 = Farm::findBySlugOrFail($request->farm_1);
        $farm_2 = Farm::findBySlugOrFail($request->farm_2);

        // Dupes
        $dupes_1 = $request->input('dupes_1', false);
        $dupes_2 = $request->input('dupes_2', false);

        // Tokens
        $upgrades_1 = Cache::remember('farm_upgrades_' . $farm_1->slug, 60, function () use ($farm_1) {
            return $farm_1->upgradeBalances()->get();
        });
        $upgrades_2 = Cache::remember('farm_upgrades_' . $farm_2->slug, 60, function () use ($farm_2) {
            return $farm_2->upgradeBalances()->get();
        });

        // Prepare
        $assets_1 = $upgrades_1->pluck('asset')->toArray();
        $assets_2 = $upgrades_2->pluck('asset')->toArray();

        // Compare
        $unique_1 = array_values(array_diff($assets_1, $assets_2));
        $unique_2 = array_values(array_diff($assets_2, $assets_1));

        // Results
        $list_1 = $farm_1->upgradeBalances()->whereIn('asset', $unique_1)->where('quantity', '>', (int) $dupes_1)->with('token.asset')->get()->sortBy('token.asset.issuance');
        $list_2 = $farm_2->upgradeBalances()->whereIn('asset', $unique_2)->where('quantity', '>', (int) $dupes_2)->with('token.asset')->get()->sortBy('token.asset.issuance');

        // Report Back
        return view('fair.store', compact('farm_1', 'farm_2', 'list_1', 'list_2'));
    }
}
