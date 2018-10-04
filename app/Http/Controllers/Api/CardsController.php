<?php

namespace App\Http\Controllers\Api;

use App\Token;
use App\Http\Resources\CardResource;
use App\Http\Resources\CardCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardsController extends Controller
{
    /**
     * List Cards
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cards = Token::with('asset')->published()->upgrades()->orderBy('meta_data->overall_ranking', 'asc')->get();

        return CardCollection::collection($cards);
    }

    /**
     * Show Card
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Token  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Token $card)
    {
        return new CardResource($card);
    }
}
