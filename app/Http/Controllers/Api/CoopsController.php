<?php

namespace App\Http\Controllers\Api;

use App\Coop;
use App\Http\Resources\CoopResource;
use App\Http\Resources\CoopCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $coops = Coop::get();

        return CoopCollection::collection($coops);
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
        return new CoopResource($coop);
    }
}
