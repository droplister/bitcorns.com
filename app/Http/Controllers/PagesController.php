<?php

namespace App\Http\Controllers;

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
        // Buy View
        return view('pages.buy');
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