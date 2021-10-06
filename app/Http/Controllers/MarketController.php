<?php

namespace App\Http\Controllers;

use Cache;
use App\Token;
use Droplister\XcpCore\App\Dispense;
use Droplister\XcpCore\App\Dispenser;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    /**
     * Dispensers
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Tokens
        $tokens = App\Token::published()->pluck('xcp_core_asset_name');

        // Dispensers
        $dispensers = Cache::remember('market_dispensers', 5, function () use ($tokens) {
            return Dispenser::whereIn('asset', $tokens)->whereStatus(0)->latest('confirmed_at')->get();
        });

        // Dispenses
        $dispenses = Cache::remember('market_dispenses', 5, function () use ($tokens) {
            return Dispense::whereIn('asset', $tokens)->latest('confirmed_at')->get();
        });

        // Index View
        return view('market.index', compact('dispensers', 'dispenses'));
    }
}
