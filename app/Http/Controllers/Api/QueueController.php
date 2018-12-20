<?php

namespace App\Http\Controllers\Api;

use App\Token;
use App\Http\Resources\CardCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QueueController extends Controller
{
    /**
     * List Cards
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cards = Token::with('asset')->pending()->upgrades()->get();

        return CardCollection::collection($cards);
    }

    /**
     * List Cards
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $cards = Token::with('asset')->approved()->upgrades()->notPublished()->get();

        return CardCollection::collection($cards);
    }
}
