<?php

namespace App\Http\Controllers\Api;

use App\Harvest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplyController extends Controller
{
    /**
     * Bitcorn Supply
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Harvest::complete()->sum('quantity');
    }
}
