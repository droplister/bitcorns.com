<?php

namespace App\Http\Controllers;

use Auth;
use App\Farm;
use App\Token;
use App\MapMarker;
use App\Http\Controllers\Traits\SortsFarms;
use App\Http\Requests\Farms\UpdateRequest;
use Illuminate\Http\Request;

class FarmsController extends Controller
{
    use SortsFarms;

    /**
     * List Farms (Sortable)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Validation
        $request->validate([
            'sort' => 'sometimes|in:access,reward,rewards,rewards-total,no-access,newest,oldest,updated'
        ]);

        // Build Query
        $farms = $this->getSortedFarms($request)->paginate(45);

        // Return View
        return view('farms.index', compact('farms', 'request'));
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
        $balances = $farm->tokenBalances()->tokens()->get();

        // Tokens: Upgrades
        $upgrades = $farm->tokenBalances()->upgrades()->nonZero()->get();

        // Tokens: Upgrades Total
        $upgrades_total = Token::whereType('upgrade')->count();

        // Tokens: % of Progress
        $progress = round($upgrades->count() / $upgrades_total * 100);

        // Return View
        return view('farms.show', compact('farm', 'balances', 'upgrades', 'progress'));
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
        /*
         * Gate / Policy Needed
         */

        // Authentication
        if(Auth::guard('farm')->check() && Auth::guard('farm')->user()->slug === $farm->slug)
        {
            // Logged In
        }
        else
        {
            if($error = $farm->validateSignature($request))
            {
                return back()->with('error', $error);
            }
        }

        // Validation
        if($error = MapMarker::validateCoordinates($request, $farm))
        {
            return back()->with('error', $error);
        }

        // Execution
        $farm->update($request->all());

        // Return Back
        return back()->with('success', 'Update Complete');
    }
}