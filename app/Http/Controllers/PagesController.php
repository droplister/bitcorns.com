<?php

namespace App\Http\Controllers;

use Cache;
use App\Token;
use App\Harvest;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * API
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function api(Request $request)
    {
        // API View
        return view('pages.api');
    }

    /**
     * Buy CROPS
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function buy(Request $request)
    {
        // Last Price
        $last_price = Cache::remember('last_price', 60, function () {
            $crops = Token::where('xcp_core_asset_name', '=', config('bitcorn.access_token'))->first();
            return $crops->lastMatch('XCP') ? number_format($crops->lastMatch('XCP')->trading_price_normalized) . ' XCP' : '0 XCP';
        });

        // Buy View
        return view('pages.buy', compact('last_price'));
    }

    /**
     * Calculator
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function calculator(Request $request)
    {
        // Upcoming Harvest
        $upcoming = Harvest::upcoming()->first();

        // Calculator View
        return view('pages.calculator', compact('upcoming'));
    }

    /**
     * Countdown
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function countdown(Request $request)
    {
        // Upcoming Harvest
        $harvest = Harvest::upcoming()->first();

        // Countdown View
        return view('pages.countdown', compact('harvest', 'request'));
    }

    /**
     * Forecast
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function forecast(Request $request)
    {
        // Upcoming Harvest
        $harvest = Harvest::upcoming()->first();

        // Forecast View
        return view('pages.forecast', compact('harvest'));
    }

    /**
     * Privacy Policy
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function privacy(Request $request)
    {
        // Privacy View
        return view('pages.privacy');
    }

    /**
     * Game Rules
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function rules(Request $request)
    {
        // Rules View
        return view('pages.rules');
    }

    /**
     * Terms of Service
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function terms(Request $request)
    {
        // Terms View
        return view('pages.terms');
    }
}