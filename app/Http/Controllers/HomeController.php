<?php

namespace App\Http\Controllers;

use Cache;
use App\Token;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Last Price
        $last_price = Cache::remember('last_price', 60, function () {
            $crops = Token::where('xcp_core_asset_name', '=', config('bitcorn.access_token'))->first();
            return number_format($crops->lastMatch()->trading_price_normalized) . ' XCP';
        });

        // Index View
        return view('home.index', compact('last_price'));
    }
}