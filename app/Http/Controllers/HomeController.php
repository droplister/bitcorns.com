<?php

namespace App\Http\Controllers;

use Cache;
use App\Farm;
use App\Token;
use App\Feature;
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
            return $crops->lastMatch('XCP') ? number_format($crops->lastMatch('XCP')->trading_price_normalized) . ' XCP' : '0 XCP';
        });

        // Features
        $cards = Feature::where('featurable_type', '=', 'App\Token')->with('featurable')->highestBids()->take(4)->get();
        $farms = Feature::where('featurable_type', '=', 'App\Farm')->with('featurable')->highestBids()->take(2)->get();
        $field = Farm::findBySlug(config('bitcorn.field_of_dreams'));

        // Index View
        return view('home.index', compact('last_price', 'cards', 'farms', 'field'));
    }
}