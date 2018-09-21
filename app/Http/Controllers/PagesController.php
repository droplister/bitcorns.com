<?php

namespace App\Http\Controllers;

use App\Token;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Buy CROPS
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function buy(Request $request)
    {
        // Last Price
        $crops = Token::where('xcp_core_asset_name', '=', config('bitcorn.access_token'))->first();
        $last_price = number_format($crops->lastMatch()->trading_price_normalized) . ' XCP';

        // Buy View
        return view('pages.buy', compact('last_price'));
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
}