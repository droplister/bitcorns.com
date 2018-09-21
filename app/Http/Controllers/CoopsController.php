<?php

namespace App\Http\Controllers;

use App\Coop;
use Illuminate\Http\Request;

class CoopsController extends Controller
{
    /**
     * List Coops
     *
     * @param  \App\Http\Requests\Farms\IndexRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        // Farm Coops
        $coops = Coop::get();

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