<?php

namespace App\Http\Controllers;

use App\Coop;
use App\Token;
use Illuminate\Http\Request;

class CoopsController extends Controller
{
    /**
     * List Coops
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Farm Coops
        $coops = Coop::has('farms')->orderBy('total_harvested', 'desc')->get();

        // Index View
        return view('coops.index', compact('coops'));
    }

    /**
     * Show Coop
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coop  $coop
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Coop $coop)
    {
        // Coop Farms
        $farms = $coop->farms()->hasAccess()
            ->withCount('harvests')
            ->orderBy('total_harvested', 'desc')
            ->get();

        // Tokens: Access and Rewards
        $tokens = $coop->tokenBalances()->get();

        // Tokens: Upgrades
        $upgrades = $coop->upgradeBalances()->get();

        // Tokens: Upgrades Total
        $upgrades_total = Token::published()->upgrades()->count();

        // Tokens: % of Progress
        $progress = round($upgrades->count() / $upgrades_total * 100);

        // Show View
        return view('coops.show', compact('coop', 'farms', 'tokens', 'upgrades', 'progress'));
    }

}