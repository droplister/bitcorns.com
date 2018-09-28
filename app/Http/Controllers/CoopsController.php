<?php

namespace App\Http\Controllers;

use App\Coop;
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
        $coops = Coop::orderBy('total_harvested', 'desc')->get();

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
        // Return View
        return view('coops.show', compact('coop'));
    }

}