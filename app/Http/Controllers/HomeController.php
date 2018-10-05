<?php

namespace App\Http\Controllers;

use Cache;
use App\Farm;
use App\Token;
use App\Feature;
use Sujip\Ipstack\Ipstack;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Homepage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Last Price
        $last_price = Token::lastPrice();

        // Featured Cards
        $cards = Feature::featuredCards();

        // Featured Farms
        $farms = Feature::featuredFarms();

        // Field of Dreams
        $field = Farm::getFieldOfDreams();

        // Visitor GEO IP
        $geoip = Cache::rememberForever($request->ip(), function () use ($request) {
            return new Ipstack($request->ip());
        });

        // Index View
        return view('home.index', compact('last_price', 'cards', 'farms', 'field', 'geoip'));
    }
}
